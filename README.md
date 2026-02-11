# Shpenzimet e Mia (Laravel 11)

A simple, mobile-friendly personal expenses tracker built with Laravel 11, MySQL, Eloquent, and Blade.

## Features
- Dashboard with month (`YYYY-MM`) and optional category filters.
- Add expense form directly on dashboard.
- Stats for selected month:
  - total monthly expenses
  - daily average (based on exact days in month)
- Breakdown by category for full selected month.
- Expense list with edit/delete.
- Category management page (create, update, delete).
- Seeded default categories.

## Setup
1. Install dependencies:
   ```bash
   composer install
   ```
2. Prepare environment file:
   ```bash
   cp .env.example .env
   ```
3. Set database credentials in `.env`.
4. Generate app key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
6. Start local server:
   ```bash
   php artisan serve
   ```

Then open `http://127.0.0.1:8000`.
