# Technology Stack

## Backend
- **Framework**: Laravel 12.x (PHP 8.2+)
- **Database**: PostgreSQL (recommended) or MySQL
- **Authentication**: Laravel Breeze with Inertia.js
- **API**: Inertia.js for SPA-like experience
- **Queue System**: Laravel Queue (Redis/Database)
- **Routing**: Ziggy for JavaScript route generation

## Frontend
- **Framework**: Vue 3 with TypeScript
- **Build Tool**: Vite 6.x
- **Styling**: Tailwind CSS 4.x
- **UI Components**: Reka UI (headless components)
- **Icons**: Lucide Vue Next
- **State Management**: VueUse composables
- **Type Safety**: Full TypeScript support with strict mode

## Development Tools
- **Code Quality**: ESLint, Prettier, Laravel Pint
- **Testing**: PHPUnit, Laravel testing utilities
- **Containerization**: Laravel Sail (Docker)
- **Package Management**: Composer (PHP), npm (Node.js)

## Common Commands

### Development
```bash
# Start full development environment
composer run dev

# Start with SSR support
composer run dev:ssr

# Frontend only development
npm run dev

# Build for production
npm run build
npm run build:ssr
```

### Testing
```bash
# Run PHP tests
composer run test
php artisan test

# Code formatting
npm run format
npm run lint
./vendor/bin/pint
```

### Database
```bash
# Run migrations
php artisan migrate

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Create migration
php artisan make:migration create_table_name
```

### Laravel Sail (Docker)
```bash
# Install Sail
php artisan sail:install

# Start containers
./vendor/bin/sail up -d

# Run artisan commands through Sail
./vendor/bin/sail artisan migrate
```