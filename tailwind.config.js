export default {
    darkMode: 'selector',
    theme: {
        extend: {
            colors: {
                brand: {
                    emerald: '#059669',
                    ghost: '#F8FAFC',
                    slate: '#0F172A',
                    indigo: '#4F46E5',
                },
            },
            fontFamily: {
                sans: ['Sora', 'Manrope', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            boxShadow: {
                soft: '0 1px 3px 0 rgb(15 23 42 / 0.08), 0 1px 2px -1px rgb(15 23 42 / 0.08)',
                premium: '0 14px 40px -24px rgb(15 23 42 / 0.25), 0 10px 16px -12px rgb(15 23 42 / 0.2)',
            },
            borderRadius: {
                '2xl': '1rem',
            },
        },
    },
};
