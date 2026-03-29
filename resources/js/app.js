import Alpine from 'alpinejs';

const ioniconsEsmSrc = 'https://unpkg.com/ionicons@7.4.0/dist/ionicons/ionicons.esm.js';
const ioniconsNoModuleSrc = 'https://unpkg.com/ionicons@7.4.0/dist/ionicons/ionicons.js';

const THEME_STORAGE_KEY = 'trustworthy-theme';
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

const readStoredTheme = () => {
	try {
		const value = window.localStorage.getItem(THEME_STORAGE_KEY);
		return value === 'light' || value === 'dark' ? value : null;
	} catch {
		return null;
	}
};

const resolveInitialTheme = () => readStoredTheme() || (prefersDark.matches ? 'dark' : 'light');

const applyTheme = (theme) => {
	document.documentElement.classList.toggle('dark', theme === 'dark');
	document.documentElement.setAttribute('data-theme', theme);
};

const persistTheme = (theme) => {
	try {
		window.localStorage.setItem(THEME_STORAGE_KEY, theme);
	} catch {
		// Ignore localStorage write failures (private mode/blocked storage)
	}
};

const initialTheme = resolveInitialTheme();
applyTheme(initialTheme);

window.Alpine = Alpine;

Alpine.store('theme', {
	current: initialTheme,
	set(theme) {
		if (theme !== 'light' && theme !== 'dark') {
			return;
		}

		this.current = theme;
		applyTheme(theme);
		persistTheme(theme);
	},
	toggle() {
		this.set(this.current === 'dark' ? 'light' : 'dark');
	},
	init() {
		const storedTheme = readStoredTheme();
		if (storedTheme) {
			this.current = storedTheme;
			applyTheme(storedTheme);
			return;
		}

		const syncWithSystem = (event) => {
			if (readStoredTheme()) {
				return;
			}

			const systemTheme = event.matches ? 'dark' : 'light';
			this.current = systemTheme;
			applyTheme(systemTheme);
		};

		if (typeof prefersDark.addEventListener === 'function') {
			prefersDark.addEventListener('change', syncWithSystem);
		} else if (typeof prefersDark.addListener === 'function') {
			prefersDark.addListener(syncWithSystem);
		}
	},
});

Alpine.start();

if (!document.querySelector(`script[src="${ioniconsEsmSrc}"]`)) {
	const moduleScript = document.createElement('script');
	moduleScript.type = 'module';
	moduleScript.src = ioniconsEsmSrc;
	document.head.appendChild(moduleScript);
}

if (!document.querySelector(`script[src="${ioniconsNoModuleSrc}"]`)) {
	const legacyScript = document.createElement('script');
	legacyScript.setAttribute('nomodule', '');
	legacyScript.src = ioniconsNoModuleSrc;
	document.head.appendChild(legacyScript);
}

const upsertMetaTag = (selector, attributes) => {
	let tag = document.head.querySelector(selector);

	if (!tag) {
		tag = document.createElement('meta');
		document.head.appendChild(tag);
	}

	Object.entries(attributes).forEach(([key, value]) => {
		tag.setAttribute(key, value);
	});
};

window.addEventListener('seo:update', (event) => {
	const detail = event.detail || {};
	const title = detail.title || document.title;
	const description = detail.description || '';

	document.title = title;

	if (description !== '') {
		upsertMetaTag('meta[name="description"]', {
			name: 'description',
			content: description,
		});
		upsertMetaTag('meta[property="og:description"]', {
			property: 'og:description',
			content: description,
		});
		upsertMetaTag('meta[name="twitter:description"]', {
			name: 'twitter:description',
			content: description,
		});
	}

	upsertMetaTag('meta[property="og:title"]', {
		property: 'og:title',
		content: title,
	});

	upsertMetaTag('meta[name="twitter:title"]', {
		name: 'twitter:title',
		content: title,
	});
});

document.addEventListener('click', (event) => {
	const link = event.target.closest('[data-seo-title]');

	if (!link) {
		return;
	}

	window.dispatchEvent(new CustomEvent('seo:update', {
		detail: {
			title: link.getAttribute('data-seo-title') || document.title,
			description: link.getAttribute('data-seo-description') || '',
		},
	}));
});
