# Shpenzimet e Mia (Laravel 11 + MySQL + Blade)

A lightweight personal expense tracker built with Laravel 11, MySQL, Blade, and Eloquent.

## Features

- Monthly dashboard with filters (`month`, optional `category_id`)
- Add, edit, and delete expenses
- Monthly stats:
  - Total monthly expenses
  - Daily average (total / days in selected month)
  - Category breakdown for full selected month
- Category management page (add, edit, delete)
- Seeded default categories

## Setup

1. Install dependencies:
   ```bash
   composer install
   ```
2. Prepare env:
   ```bash
   cp .env.example .env
   ```
3. Configure DB credentials in `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
4. Generate app key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations + seed:
   ```bash
   php artisan migrate --seed
   ```
6. Start app:
   ```bash
   php artisan serve
   ```

## Main Routes

- `GET /` -> redirect to `/dashboard`
- `GET /dashboard?month=YYYY-MM&category_id=ID`
- `POST /expenses`
- `GET /expenses/{expense}/edit`
- `PUT /expenses/{expense}`
- `DELETE /expenses/{expense}`
- `GET /categories`
- `POST /categories`
- `PUT /categories/{category}`
- `DELETE /categories/{category}`

## Seeded Categories

- Makina
- Ushqim
- Femija
- Rroba
- Te papritura
