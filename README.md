# anithq/password

A secure password and credit card management application built with modern Laravel technologies. Features team-based collaboration, encrypted data storage, and a beautiful Flux UI interface.

## Features

- **Password Management**: Store, search, and manage passwords with secure auto-generation
- **Credit Card Management**: Securely store credit cards with automatic brand detection (Visa, Mastercard, Amex)
- **Team Collaboration**: Built on Laravel Jetstream for team-based access control and member management
- **Data Security**: Encrypted storage for sensitive fields (passwords, card numbers, CVV, notes)
- **Rich Notes**: Integrated Tiptap editor for formatted notes with link support
- **Authentication**: Fortify-powered authentication with 2FA, email verification, and password reset
- **PWA Ready**: Progressive Web App with custom icons and web app manifest
- **Dark Mode**: Full dark mode support with automatic theme detection
- **Search**: Real-time search across passwords and credit cards
- **Autocomplete**: Smart autocomplete for usernames and cardholder names
- **Copy to Clipboard**: One-click copy for passwords and masked card numbers

## Tech Stack

### Backend
- **Laravel 12**: Modern PHP framework
- **Livewire 4**: Full-stack framework for dynamic interfaces
- **Laravel Fortify**: Authentication scaffolding
- **Laravel Jetstream**: Team and user management
- **Laravel Sanctum**: API authentication

### Frontend
- **Flux UI Pro**: Beautiful component library for Livewire
- **Tailwind CSS v4**: Utility-first CSS framework
- **Vite**: Fast build tool and dev server
- **Alpine.js**: Lightweight JavaScript framework (included with Livewire)

### Testing & Development
- **Pest 4**: Elegant testing framework
- **Laravel Pint**: Code style fixer
- **Honeybadger**: Error tracking
- **Pail**: Real-time log viewer

## Requirements

- PHP 8.4 or higher
- Composer
- Node.js 18 or higher
- SQLite (default) or MySQL/PostgreSQL

## Installation

1. **Clone the repository**

```bash
git clone https://github.com/antihq/password.git
cd password
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Configure environment**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Run migrations**

```bash
php artisan migrate
```

5. **Build assets**

```bash
npm run build
```

6. **Start the development server**

```bash
composer run dev
```

This will start:
- PHP server (http://localhost:8000)
- Queue worker
- Log viewer (Pail)
- Vite dev server with hot module replacement

## Configuration

### Environment Variables

Key environment variables in `.env`:

```env
APP_NAME=antihq/password
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# Or use MySQL/PostgreSQL
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025

HONEYBADGER_API_KEY=
```

### Encryption

The application uses Laravel's encrypted casts to secure sensitive data:

- **Passwords**: Encrypted using `encrypted` cast
- **Credit Card Numbers**: Encrypted and stored without spaces
- **CVV**: Encrypted
- **Notes**: Encrypted rich text content

Encryption uses your `APP_KEY` from the `.env` file. Keep this key secure and never commit it to version control.

## Development

### Running the Application

For development with hot reloading and real-time logs:

```bash
composer run dev
```

This command runs:
- `php artisan serve` - Laravel development server
- `php artisan queue:listen` - Queue worker
- `php artisan pail` - Real-time log viewer
- `npm run dev` - Vite dev server with HMR

### Building for Production

```bash
npm run build
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Code Formatting

Use Laravel Pint to format code:

```bash
vendor/bin/pint --dirty
```

## Testing

Run the test suite using Pest:

```bash
# Run all tests
composer test

# Run specific test file
php artisan test tests/Feature/PasswordModelTest.php

# Run specific test
php artisan test --filter=test_name
```

### Test Coverage

The project includes tests for:
- Authentication (login, registration, password reset, 2FA, email verification)
- Password model attributes and relationships
- Credit card model attributes, card brand detection, and formatting
- Avatar components
- Dashboard functionality

## Project Structure

```
anithq-password/
├── app/
│   ├── Livewire/           # Livewire components
│   ├── Models/             # Eloquent models
│   ├── Policies/           # Authorization policies
│   └── View/Components/     # Blade components
├── database/
│   ├── factories/          # Model factories
│   └── migrations/         # Database migrations
├── resources/
│   ├── css/                # Tailwind CSS
│   ├── js/                 # JavaScript
│   └── views/              # Blade templates
└── tests/
    ├── Feature/            # Feature tests
    └── Unit/               # Unit tests
```

## Security Considerations

- **Encryption**: All sensitive data is encrypted at rest using Laravel's encryption
- **Authorization**: Team-based policies ensure users can only access their own team's data
- **Authentication**: Multi-factor authentication, email verification, and password confirmation for sensitive actions
- **Input Validation**: Server-side validation using Form Request classes
- **CSRF Protection**: Built-in Laravel CSRF protection
- **SQL Injection**: Uses Eloquent ORM with parameter binding
- **XSS Protection**: Blade templates auto-escape output; Tiptap editor sanitizes HTML

## Deployment

### Recommended Deployment Checklist

1. Set `APP_ENV=production` and `APP_DEBUG=false` in production environment
2. Use a strong `APP_KEY` and keep it secret
3. Configure a proper database (MySQL/PostgreSQL recommended for production)
4. Set up proper queue driver (Redis recommended)
5. Configure email services for transactional emails
6. Set up SSL/TLS certificates
7. Configure file permissions properly
8. Run database migrations
9. Build and cache assets
10. Set up backup strategy for database and encrypted data

### Deployment Commands

```bash
# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Queue workers (if using queue)
php artisan queue:work --daemon
```

## License

This project is licensed under the O'Saasy License. See [LICENSE](LICENSE) for details.

**Key License Terms:**
- Free to use, modify, merge, publish, distribute, and sell
- May not be used to directly compete with the original licensor as a hosted or SaaS product
- Provided "AS IS" without warranty

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For issues and questions, please use the GitHub issue tracker.

## Credits

- Built with [Laravel](https://laravel.com)
- UI components by [Flux UI](https://fluxui.dev)
- Inspired by the need for secure, team-friendly password management
