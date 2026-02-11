# devshayan

Personal portfolio + blog built with **PHP (MVC + OOP)**, **Tailwind CSS v4**, and **Vanilla JS**.

## Requirements
- PHP >= 8.1
- Composer
- Node.js + npm
- MySQL (recommended) or SQLite

## Setup
```bash
composer install
cp .env.example .env
npm install
npm run build:css
```

### Database (MySQL)
Create a database named `devshayan`, then:
```bash
php cli/migrate.php
php cli/seed.php
```

### Run
```bash
php -S localhost:8000 -t public public/router.php
```
Open: http://localhost:8000

## Admin panel
- Login: `/admin/login`
- Default users are created by `php cli/seed.php` using `.env`:
  - `ADMIN_EMAIL` / `ADMIN_PASSWORD`
  - `EDITOR_EMAIL` / `EDITOR_PASSWORD`

## Development (watch CSS)
```bash
npm run dev:css
```

## Deployment note
GitHub Pages does **not** run PHP. Host this project on a PHP-capable server/platform.
