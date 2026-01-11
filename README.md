# AntiPassword

A team-based password manager built with Laravel 12, Livewire v4, and Flux UI Pro. Securely store, manage, and share passwords within your team.

## Features

- Password encryption at rest
- Team collaboration and member management
- Strong password generation
- Copy-to-clipboard functionality
- Two-factor authentication
- Dark mode support
- Progressive Web App (PWA)

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (default) or MySQL/PostgreSQL

## Quick Start

### Installation

```bash
# Clone the repository
git clone https://github.com/antihq/password.git
cd password

# Install dependencies
composer install
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Build assets
npm run build
```

### Development

```bash
# Run the development server (includes Vite dev server)
composer run dev
```

The application will be available at `https://antihq-password.test` (Laravel Herd) or `http://localhost:8000`.

### Testing

```bash
# Run all tests
php artisan test --compact

# Run a specific test file
php artisan test --compact tests/Feature/PasswordTest.php
```

### Production Build

```bash
# Build assets for production
npm run build

# Optimize the application
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Usage

1. **Sign up**: Create an account to get started
2. **Create team**: Your personal team is created automatically
3. **Add passwords**: Navigate to Passwords to add credentials
4. **Generate passwords**: Use the sparkle icon to auto-generate strong passwords
5. **Collaborate**: Create teams and invite members to share passwords
6. **Copy credentials**: Click the copy icon to quickly copy usernames/passwords

## License

O'Saasy License Agreement - See the LICENSE file for details.

## Support

- Email: oliver@antihq.com
- Twitter: [@oliverservinX](https://x.com/oliverservinX)
