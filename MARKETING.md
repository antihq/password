# Secure Password & Credit Card Management for Teams and Individuals

## Your Digital Vault, Reinvented

Welcome to **antihq/password** — the secure, self-hosted solution for managing your most sensitive information. Whether you're a solo user, a small business owner, or leading a team, we make protecting your passwords and credit cards simple, beautiful, and completely under your control.

---

## Why Choose antihq/password?

In a world where every service requires a password and every payment needs a card, juggling credentials can be overwhelming. Cloud-based password managers often come with privacy concerns and monthly fees. We believe you should have full ownership of your data — without compromising on features or user experience.

antihq/password gives you:
- ✅ **Complete control** — Self-host and own your data forever
- ✅ **Team collaboration** — Share credentials securely with your team
- ✅ **Modern experience** — Beautiful, intuitive interface that just works
- ✅ **Zero compromise on security** — Military-grade encryption built-in
- ✅ **Works everywhere** — Progressive Web App for desktop and mobile

---

## 🚀 Features That Make Life Easier

### Password Management

**Store with Confidence**
- Save unlimited passwords with names, usernames, websites, and rich notes
- Automatically fetch website favicons for easy visual recognition
- Copy passwords, usernames, and URLs to clipboard with one click
- Show or hide passwords at will — your secret, your choice

**Generate Strong Passwords Instantly**
- Create 18-character secure passwords with a single click
- Format: lowercase-alphanumeric-uppercase with hyphens for maximum compatibility
- Never reuse passwords or struggle to invent new ones again

**Smart Autocomplete**
- Username suggestions based on your existing entries
- Cardholder name autocomplete for faster credit card entry
- The more you use it, the smarter it gets

**Find Anything Fast**
- Real-time search across all your passwords and credit cards
- No more scrolling through endless lists
- Results appear instantly as you type

**Rich Notes with Formatting**
- Integrated Tiptap editor for beautiful, formatted notes
- Add links, bullet points, and more
- Perfect for storing security questions, recovery codes, or additional context

### Credit Card Management

**Secure Card Storage**
- Store cardholder names, card numbers, expiry dates, and CVV
- Automatic brand detection for Visa, Mastercard, and Amex
- Smart input formatting (15 digits for Amex, 16 for others)
- Shows only last 4 digits by default — security first

**Automatic Brand Recognition**
- Visa starts with 4
- Mastercard starts with 5 or 2
- Amex starts with 34 or 37
- Automatically fetches card brand logos via Unavatar.io

**Smart Expiry Validation**
- Never save expired cards
- Clear expiry date display (MM/YYYY format)
- Get notified when cards are about to expire

**Quick Access When You Need It**
- One-click copy for card numbers, CVV, expiry dates, and names
- Masked display protects your privacy
- Perfect for online shopping or filling out forms

### Team Collaboration

**Built for Teams from Day One**
- Create and manage multiple teams
- Invite team members via email with secure invitation system
- Each password and credit card belongs to a specific team
- Switch between teams effortlessly

**Control Access, Protect Data**
- Team members can only access their own team's data
- Built-in authorization policies keep information isolated
- Remove team members while preserving your data
- Perfect for small businesses, agencies, and families

**Manage Memberships**
- Add, remove, and manage team members
- View all active team members at a glance
- Email-based invitations for seamless onboarding

### Authentication & Security

**Multi-Layer Protection**
- **Two-Factor Authentication (2FA)** — Add an extra layer of security
- **Email Verification** — Confirm your email address during registration
- **Password Confirmation** — Required for sensitive actions
- **Password Reset** — Secure self-service reset flows

**Encrypted Everything That Matters**
- AES-256-CBC encryption for all sensitive data
- Passwords encrypted at rest
- Credit card numbers encrypted
- CVV codes encrypted
- Rich text notes encrypted

**Session Management**
- View and manage all active devices
- Generate temporary login links (expires in 15 minutes)
- QR code login for mobile devices
- Log out from all devices with one click

**API Access**
- Generate secure API tokens for programmatic access
- Perfect for automation and integrations
- Full control over token management

### User Experience

**Progressive Web App (PWA)**
- Install on desktop, laptop, tablet, and mobile
- Offline capabilities when you need them
- Custom icons and app manifest
- Works like a native app

**Beautiful Themes**
- Light mode for bright environments
- Dark mode for late-night work
- System preference that adapts automatically
- Seamless switching between themes

**Device-Friendly Login**
- Scan a QR code to log in on your phone
- Generate temporary login links for quick device access
- No more typing passwords on mobile keyboards

**Profile Management**
- Upload profile photos
- Update name and email
- Change password with current password verification
- Delete your account when you're ready

---

## 🎯 Who Is This For?

### For Individuals

**Digital Minimalists**
If you want one secure place to store everything without monthly fees or cloud dependencies, antihq/password is your answer.

**Privacy Advocates**
Your data stays on your server. No cloud sync, no third-party access, no snooping. You are in complete control.

**Freelancers & Consultants**
Manage client credentials, credit cards, and project access in one place. Share selectively when needed.

**Tech-Savvy Users**
Love self-hosting? Want to customize and extend? Built on Laravel, it's developer-friendly and highly customizable.

### For Teams & Small Businesses

**Small Teams (3-50 people)**
Share passwords for shared accounts (AWS, Google Workspace, Stripe, etc.) without emailing them insecurely.

**Agencies & Consultancies**
Manage client credentials per project or per team. Perfect for marketing agencies, dev shops, and design firms.

**Family Offices**
Securely store family passwords, credit cards, and financial information with controlled access for trusted members.

**Startups**
Get started quickly with team collaboration built-in. Scale from founders to employees seamlessly.

**Remote Teams**
Collaborate on credentials regardless of location. Perfect for distributed teams who need shared access.

---

## 🔒 Security Built From the Ground Up

### Encryption That Protects Your Data

Every piece of sensitive information is encrypted using **AES-256-CBC** — the same standard used by banks and governments. Your data is encrypted:

- **At rest** — When stored in the database
- **In use** — When displayed in the application (decrypted only when you're authenticated)
- **During backup** — Your backups contain only encrypted data

**What's Encrypted?**
- ✅ Passwords
- ✅ Credit card numbers
- ✅ CVV codes
- ✅ Rich text notes
- ✅ All other sensitive fields

### Access Control & Authorization

**Team-Based Isolation**
- Each password and credit card belongs to a specific team
- Users can only access their team's data
- No cross-team data leakage possible

**Role-Based Permissions**
- Built on Laravel's authorization policies
- Fine-grained control over who can do what
- Automatic enforcement at every level

### Authentication Best Practices

**Strong Password Requirements**
- Enforce secure passwords during registration
- Password confirmation for sensitive actions
- Bcrypt hashing for stored passwords

**Multi-Factor Authentication (2FA)**
- Add TOTP-based 2FA for extra security
- Required for team-sensitive operations
- Easy setup with QR codes

**Session Security**
- Database-backed session storage
- CSRF protection on all forms
- Secure cookie configuration
- Automatic timeout and logout

### Development Security Standards

- **SQL Injection Protection** — Uses Eloquent ORM with parameter binding
- **XSS Prevention** — Blade templates auto-escape output; Tiptap sanitizes HTML
- **CSRF Protection** — Built-in Laravel CSRF tokens on all forms
- **Input Validation** — Server-side validation using Form Request classes
- **Secure Headers** — Proper security headers configured
- **Error Handling** — No sensitive data exposed in error messages

---

## 💡 Use Cases

### Scenario 1: Marketing Agency

**Problem:** 15 employees need access to 50+ client accounts across social media, Google Ads, web hosting, and email platforms.

**Solution with antihq/password:**
- Create teams per client or per project
- Invite team members to relevant teams
- Store all client passwords securely
- Team members access only their assigned client credentials
- When employees leave, remove access with one click — no password changes needed

### Scenario 2: Small Business Owner

**Problem:** Managing personal passwords, business accounts, shared team passwords, and credit cards across multiple devices.

**Solution with antihq/password:**
- Create a personal team for personal accounts
- Create a business team for company resources
- Store credit cards securely for online purchases
- Install as PWA on phone, tablet, and laptop
- Use QR code login on mobile — no typing required

### Scenario 3: Family with Shared Services

**Problem:** Family needs shared access to streaming services, utilities, and financial accounts while keeping some information private.

**Solution with antihq/password:**
- Create family team for shared accounts (Netflix, utilities, etc.)
- Create personal teams for individual members
- Parents can manage family accounts
- Children access only shared services
- Peace of mind with encrypted storage

### Scenario 4: Development Shop

**Problem:** Multiple clients, multiple environments, multiple teams — too many credentials to manage securely.

**Solution with antihq/password:**
- Create teams per client or per project
- Store environment credentials and API keys in notes
- Share access with relevant developers
- Rotate credentials easily when needed
- Self-hosted means no dependency on third-party services

---

## 🛠️ Technology You Can Trust

Built on modern, battle-tested technologies:

- **Laravel 12** — The world's most popular PHP framework
- **Livewire 4** — Dynamic, reactive interfaces without JavaScript complexity
- **Flux UI Pro** — Beautiful, accessible components
- **Tailwind CSS v4** — Modern, responsive styling
- **Pest 4** — Comprehensive test coverage
- **Tiptap** — Powerful rich text editor

### Why This Matters

When you self-host antihq/password, you're not just hosting any app — you're hosting a Laravel application. Laravel is trusted by millions of developers and powers applications of all sizes, from startups to Fortune 500 companies.

---

## 🌟 What Makes antihq/password Different?

| Feature | antihq/password | Cloud Password Managers | DIY Solutions |
|---------|----------------|----------------------|---------------|
| **Data Ownership** | ✅ You own everything | ❌ Stored on their servers | ✅ You own everything |
| **Monthly Fees** | ✅ None (one-time license) | ❌ Usually $3-$12/month | ✅ Free if you build it |
| **Team Collaboration** | ✅ Built-in, unlimited teams | ✅ Often extra cost | ❌ Time-consuming to build |
| **Credit Card Management** | ✅ Integrated | ❌ Rarely included | ❌ Time-consuming to build |
| **Self-Hosted** | ✅ Yes | ❌ No | ✅ Yes |
| **Beautiful UI** | ✅ Flux UI Pro | ✅ Depends on provider | ❌ Requires design skills |
| **Modern Tech Stack** | ✅ Laravel 12, Livewire 4 | ✅ Varies | ❌ Varies by skills |
| **PWA Support** | ✅ Native feel on all devices | ✅ Usually yes | ❌ Time-consuming to add |
| **QR Code Login** | ✅ Innovative feature | ❌ Rare | ❌ Time-consuming to build |
| **Encrypted Notes** | ✅ Rich text with encryption | ✅ Sometimes | ❌ Time-consuming to build |
| **Time to Deploy** | ✅ Minutes | ✅ Zero | ❌ Weeks or months |

---

## 🎁 Everything You Need, Nothing You Don't

### Included Out of the Box

- Password management with search and filtering
- Credit card management with brand detection
- Team creation and member management
- Rich text notes with Tiptap editor
- Two-factor authentication
- Email verification
- Password reset flows
- Device management
- API token management
- Progressive Web App support
- Light and dark themes
- QR code login
- Temporary login links
- Real-time search
- Clipboard copy functionality
- Encrypted data storage
- Comprehensive test coverage

### What You Won't Find

- ❌ Monthly subscription fees
- ❌ Data limits or storage quotas
- ❌ Cloud dependencies
- ❌ Privacy violations
- ❌ Complex setup (we've made it easy!)
- ❌ Outdated technology (Laravel 12, Livewire 4)
- ❌ Clunky interfaces (Flux UI Pro is beautiful)
- ❌ Hidden costs (what you see is what you get)

---

## 🚀 Getting Started Is Simple

### Requirements

- PHP 8.4 or higher
- Composer
- Node.js 18 or higher
- SQLite (default) or MySQL/PostgreSQL

### Quick Setup

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

6. **Start the server**
   ```bash
   composer run dev
   ```

That's it! Visit `http://localhost:8000` and start securing your passwords.

---

## 📱 Works Where You Work

### Desktop & Laptop
- Windows, macOS, Linux
- Chrome, Firefox, Safari, Edge
- PWA installation for native app experience

### Mobile & Tablet
- iOS (Safari, Chrome)
- Android (Chrome, Firefox)
- Install as app for quick access

### Self-Host Anywhere
- VPS (DigitalOcean, Linode, Vultr)
- Cloud (AWS, Google Cloud, Azure)
- Home server (Raspberry Pi, Synology, QNAP)
- Docker container
- Kubernetes cluster

---

## 🔐 Your Data, Your Rules

### Self-Hosted Means You're in Control

- **Choose your server** — Deploy anywhere you want
- **Set your own backup policies** — Your data, your responsibility
- **Customize to your needs** — Open source codebase
- **No vendor lock-in** — Export or migrate whenever you want
- **Privacy by design** — No data leaves your server

### Backup & Restore

Your data is too important to lose. We recommend:

- **Daily database backups** — Automate with cron jobs
- **Encrypted backup storage** — Store offsite securely
- **Keep your APP_KEY safe** — Required to decrypt backups
- **Test restores regularly** — Ensure your backups work

---

## 💎 Ready to Secure Your Digital Life?

antihq/password is more than just a password manager — it's a complete vault for your team's digital identity.

**For Individuals:**
- Stop using the same password everywhere
- Generate strong passwords without thinking
- Access your data on any device

**For Teams:**
- Share credentials securely
- Manage access centrally
- Remove ex-employees instantly

**For Everyone:**
- Own your data completely
- Pay once, use forever
- Modern, beautiful experience

---

## 📄 License

This project is licensed under the **O'Saasy License**.

**What this means:**
- ✅ Free to use, modify, merge, publish, distribute, and sell
- ✅ Self-host for personal or business use
- ✅ Customize and extend as needed
- ❌ May not be used to directly compete as a hosted/SaaS product

See [LICENSE](LICENSE) for full details.

---

## 🙏 Credits

Built with love using:
- [Laravel](https://laravel.com) — The PHP framework for web artisans
- [Livewire](https://livewire.laravel.com) — Full-stack framework for Laravel
- [Flux UI](https://fluxui.dev) — Beautiful component library
- [Tiptap](https://tiptap.dev) — Headless rich text editor
- [Tailwind CSS](https://tailwindcss.com) — Rapid UI development

---

## 🤝 Support & Community

- 📦 [GitHub Repository](https://github.com/antihq/password)
- 🐛 [Report Issues](https://github.com/antihq/password/issues)
- 💬 [Discussions](https://github.com/antihq/password/discussions)
- 📖 [Documentation](https://github.com/antihq/password/blob/main/README.md)

---

**Take control of your digital security today.** 🚀🔒
