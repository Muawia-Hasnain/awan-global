# Copilot Instructions for AI Coding Agents

## Project Overview
This is a Laravel-based web application for managing food-related business operations. The codebase follows standard Laravel conventions but includes custom models, controllers, and workflows specific to the domain.

## Architecture & Key Components
- **Models**: Located in `app/Models/`, representing core entities (e.g., `Product`, `Order`, `Customer`, `Category`, `Subcategory`, `WholesaleInquiry`).
- **Controllers**: In `app/Http/Controllers/`, handling HTTP requests and business logic.
- **Requests & Middleware**: Custom validation and request handling in `app/Http/Requests/` and `app/Http/Middleware/`.
- **Views**: Blade templates in `resources/views/`, organized by feature (e.g., `admin/categories/index.blade.php`).
- **Routes**: Defined in `routes/web.php` (main app), `routes/auth.php` (authentication), and `routes/console.php` (CLI commands).
- **Database**: Migrations in `database/migrations/`, seeders in `database/seeders/`, and factories in `database/factories/`.

## Developer Workflows
- **Build & Assets**: Uses Vite and Tailwind CSS. Build assets with:
  ```powershell
  npm install ; npm run build
  ```
- **Testing**: Run PHP unit tests with:
  ```powershell
  vendor\bin\phpunit
  ```
- **Database Migrations**: Apply migrations with:
  ```powershell
  php artisan migrate
  ```
- **Seeding**: Seed the database with:
  ```powershell
  php artisan db:seed
  ```
- **Serve Locally**: Start the development server:
  ```powershell
  php artisan serve
  ```

## Project-Specific Patterns & Conventions
- **Feature Organization**: Admin features are grouped under `resources/views/admin/` and related controllers/models.
- **Custom Relationships**: Models often use Eloquent relationships (e.g., `Order` has many `OrderItem`s, `Product` belongs to `Category`/`Subcategory`).
- **Role Management**: User roles are managed via a custom migration (`add_role_to_users_table`).
- **Customer Integration**: Orders are linked to customers (`add_customer_id_to_orders_table` migration).
- **Featured Products**: Products can be marked as featured (`add_featured_to_products_table` migration).

## Integration Points
- **External Packages**: Managed via Composer (`composer.json`).
- **Frontend**: Uses Vite for JS/CSS bundling, Tailwind for styling.
- **Storage**: Public assets in `public/storage`, private files in `storage/app/private/`.

## Example: Adding a New Product Feature
1. Create migration in `database/migrations/`.
2. Update `Product` model in `app/Models/Product.php`.
3. Add controller logic in `app/Http/Controllers/`.
4. Update Blade views in `resources/views/admin/products/`.
5. Add routes in `routes/web.php`.

## References
- [Laravel Documentation](https://laravel.com/docs)
- Key files: `app/Models/Product.php`, `app/Http/Controllers/`, `resources/views/admin/`, `routes/web.php`, `database/migrations/`

---
**Feedback:** Please review and suggest additions or clarifications for any unclear or missing sections.
