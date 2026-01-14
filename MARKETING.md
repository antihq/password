# Secure Password & Credit Card Management for Teams and Individuals

## Your Digital Vault, Reinvented

Welcome to **antihq/password** — the secure, intuitive solution for managing your most sensitive information. Whether you're a solo user, a small business owner, or leading a team, we make protecting your passwords and credit cards simple, beautiful, and completely secure.

---

## Why Choose antihq/password?

In a world where every service requires a password and every payment needs a card, juggling credentials can be overwhelming. Cloud-based password managers often lack team features or charge hidden fees. We believe security should be simple, powerful, and accessible to everyone.

antihq/password gives you:
- ✅ **Peace of mind** — Military-grade encryption protects everything you store
- ✅ **Team collaboration** — Share credentials securely with your team
- ✅ **Modern experience** — Beautiful, intuitive interface that just works
- ✅ **Zero compromise on security** — Multi-factor authentication and encrypted storage
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
If you want one secure place to store everything without the hassle, antihq/password is your answer.

**Privacy Advocates**
Your data is encrypted end-to-end. We never see your passwords, only you do.

**Freelancers & Consultants**
Manage client credentials, credit cards, and project access in one place. Share selectively when needed.

**Security-Conscious Users**
You care about strong passwords, 2FA, and data encryption — and we've got you covered.

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
- Focus on building, not managing spreadsheets

---

## 🛠️ Built on Proven Technology

antihq/password is built on a foundation of battle-tested technologies:

- **Laravel** — Powers millions of applications worldwide
- **Comprehensive Testing** — Rigorous test coverage ensures reliability
- **Modern Security Practices** — Industry-standard security protocols
- **Continuous Updates** — Regular security patches and improvements

### Why This Matters

You're not just getting another password manager — you're getting a platform engineered for reliability and security. We handle all the technical complexity, so you can focus on what matters: protecting your digital life.

---

## 🌟 What Makes antihq/password Different?

| Feature | antihq/password | Typical Password Managers | Built-in Browser Managers |
|---------|----------------|----------------------|---------------|
| **Password Management** | ✅ Full-featured | ✅ Yes | ⚠️ Basic only |
| **Credit Card Management** | ✅ Integrated | ❌ Rare | ❌ No |
| **Team Collaboration** | ✅ Built-in, unlimited teams | ❌ Often expensive/limited | ❌ No |
| **Rich Text Notes** | ✅ Tiptap editor with encryption | ⚠️ Sometimes | ❌ No |
| **QR Code Login** | ✅ Innovative feature | ❌ Rare | ❌ No |
| **Beautiful UI** | ✅ Modern, intuitive design | ⚠️ Varies | ⚠️ Basic |
| **PWA Support** | ✅ Install on all devices | ⚠️ Sometimes | ❌ No |
| **2FA Support** | ✅ Built-in | ✅ Usually yes | ❌ No |
| **Search** | ✅ Real-time, fast | ✅ Yes | ⚠️ Limited |
| **Multi-Device** | ✅ Seamless sync | ✅ Yes | ⚠️ Limited |

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

- ❌ Data limits or storage quotas
- ❌ Complicated setup (we've made it easy!)
- ❌ Clunky, outdated interfaces
- ❌ Hidden costs or surprise fees
- ❌ Weakening security for convenience
- ❌ Making you manage technical infrastructure

---

## 🚀 Get Started in Minutes

### Sign Up

1. **Create your account** — Just your email and a password
2. **Verify your email** — Quick verification keeps your account secure
3. **Set up 2FA** — Add two-factor authentication for extra protection
4. **Start adding** — Save your first password or credit card

That's it! No installation, no configuration, no technical knowledge required.

### Need Help?

Our comprehensive help documentation guides you through every feature:
- Setting up teams
- Inviting team members
- Managing devices
- Using API tokens
- Best practices for security

---

## 📱 Works Where You Work

### Desktop & Laptop
- Windows, macOS, Linux
- Chrome, Firefox, Safari, Edge
- Install as PWA for native app experience

### Mobile & Tablet
- iOS (Safari, Chrome)
- Android (Chrome, Firefox)
- Install as app for quick, secure access

### Always in Sync
- Your data syncs seamlessly across all devices
- Offline access — works even without internet
- Updates happen automatically — no manual updates needed

---

## 🔐 We Protect Your Data

### Our Security Promise

- **End-to-end encryption** — Your data is encrypted at rest and in transit
- **Regular backups** — We automatically backup your data daily
- **Security monitoring** — We actively monitor for threats and vulnerabilities
- **Compliance ready** — Built with security best practices in mind

### Your Data Ownership

- **Export anytime** — Take your data with you whenever you want
- **Delete on request** — We delete your data permanently when you close your account
- **Transparent policies** — We're clear about how we handle your data
- **No sharing** — We never share your data with third parties for marketing or advertising

---

## 💎 Ready to Secure Your Digital Life?

antihq/password is more than just a password manager — it's a complete vault for your team's digital identity.

**For Individuals:**
- Stop using the same password everywhere
- Generate strong passwords without thinking
- Access your data on any device, anytime

**For Teams:**
- Share credentials securely
- Manage access centrally
- Remove ex-employees instantly
- Audit access across your organization

**For Everyone:**
- Your data is always encrypted
- Zero technical setup required
- Beautiful, modern experience
- Support when you need it

---

## 🤝 Support

Questions? Need help? We're here for you.

- 📧 Email us at support@antihq.com
- 📖 Check our help documentation
- 🐛 Report bugs and feature requests
- 💬 Join our community discussions

---

**Ready to secure your passwords? [Sign up today](https://antihq.com/password/signup) and get started in minutes.** 🚀🔒
