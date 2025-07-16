# Project Structure

## Backend (Laravel)

### Core Application
- `app/Models/` - Eloquent models (User, Pet, Item, Inventory, Location)
- `app/Http/Controllers/` - Request handlers organized by feature
  - `Auth/` - Authentication controllers
  - `Settings/` - User settings management
- `app/Http/Requests/` - Form request validation classes
- `app/Http/Middleware/` - Custom middleware (HandleInertiaRequests, HandleAppearance)
- `app/Enums/` - PHP enums for type safety (ItemTypeEnum, PetColourEnum)
- `app/Providers/` - Service providers

### Database
- `database/migrations/` - Database schema definitions
- `database/seeders/` - Data seeding classes
- `database/factories/` - Model factories for testing

### Configuration
- `config/` - Laravel configuration files
- `routes/` - Route definitions
- `bootstrap/` - Application bootstrap files

## Frontend (Vue + TypeScript)

### Core Structure
- `resources/js/app.ts` - Main application entry point
- `resources/js/ssr.ts` - Server-side rendering entry
- `resources/js/pages/` - Inertia.js page components
  - `auth/` - Authentication pages
  - `settings/` - User settings pages
  - `user/` - User-specific pages (Pets, Inventory)
  - `pets/` - Pet management pages

### Components
- `resources/js/components/` - Reusable Vue components
  - `ui/` - UI component library (buttons, cards, dialogs, etc.)
  - App-specific components (AppShell, AppHeader, etc.)
- `resources/js/composables/` - Vue composables for shared logic
- `resources/js/layouts/` - Page layout components
- `resources/js/lib/` - Utility functions and helpers

### Types & Configuration
- `resources/js/types/` - TypeScript type definitions
- `resources/css/` - Stylesheets and Tailwind CSS

## Key Conventions

### File Naming
- **PHP**: PascalCase for classes, camelCase for files/methods
- **Vue**: PascalCase for components, camelCase for props/methods
- **TypeScript**: camelCase for variables/functions, PascalCase for types/interfaces

### Component Organization
- UI components follow atomic design principles
- Page components are organized by feature/route
- Shared components live in the root components directory
- Each UI component has its own folder with index.ts for exports

### Enum Conventions
- Enum values: CamelCase (e.g., `Dog`, `Cat`, `SmallBird`)
- Avoid SCREAMING_CASE for enum values
- Enum class names: PascalCase with `Enum` suffix (e.g., `PetSpeciesEnum`)
- Use descriptive, readable names that match the domain

### Database Conventions
- Table names: singular (e.g., `pet`, not `pets`)
- Foreign keys: `{model}_id` format
- Timestamps: Laravel's `created_at`/`updated_at`
- Use migrations for all schema changes

### Route Organization
- Group related routes by feature
- Use resource controllers where appropriate
- Inertia.js handles SPA routing on frontend
- Ziggy generates JavaScript routes from Laravel routes