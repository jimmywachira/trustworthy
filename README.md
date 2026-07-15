# trustworthy

## Deploying to Vercel (Laravel + Vite)

This project is configured for Vercel using a PHP serverless entrypoint at `api/index.php` and static assets served from `public/`.

### 1) Prerequisites

- A Vercel account connected to this repository.
- A production database (MySQL/PostgreSQL). Do **not** use SQLite for Vercel production.

### 2) Required environment variables in Vercel

Set these in **Project Settings → Environment Variables**:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY=base64:...` (generate with `php artisan key:generate --show`)
- `APP_URL=https://<your-vercel-domain>`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `SESSION_DRIVER=database`
- `CACHE_STORE=database`
- `QUEUE_CONNECTION=database`

### 3) Build/deploy behavior

Deployment is controlled by `vercel.json`:

- `installCommand` installs PHP and Node dependencies
- `buildCommand` builds Vite assets and runs Laravel optimization via `composer run vercel-build`
- `api/index.php` boots Laravel for dynamic routes
- `/build/*` and other static assets are served from `public/`

### 4) Database migrations

After first deploy, run migrations against your production database (from CI or local machine pointing to prod DB):

```bash
php artisan migrate --force
```
