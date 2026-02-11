# devshayan

Personal portfolio / resume website built with **PHP (MVC + OOP)** + **Tailwind CSS v4** + **Vanilla JS**.

## Requirements
- PHP >= 8.1
- Composer
- Node.js + npm

## Setup
```bash
composer install
cp .env.example .env
npm install
npm run build:css
php -S localhost:8000 -t public
Open: http://localhost:8000
```

## Development (watch CSS)
Run in a separate terminal:
```bash
npm run dev:css
```

## Notes about GitHub
GitHub Pages does not run PHP.
You can still host the repo on GitHub, but deploy the app to a PHP-capable host (shared hosting/VPS) or platforms that support PHP.

Roadmap

Admin panel to manage all content (profile, skills, experience, projects, uploads)

Content stored in JSON/DB + CRUD in /admin