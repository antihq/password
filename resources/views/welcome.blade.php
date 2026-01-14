<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head', ['title' => 'Welcome'])
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-zinc-950">
        <div class="flex min-h-screen flex-col">
            <header class="border-b border-zinc-950/5 bg-white/80 backdrop-blur-sm dark:border-white/10 dark:bg-zinc-900/80">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 sm:px-8 lg:px-12">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold">
                        <x-app-logo-icon class="size-8 fill-current text-zinc-950 dark:text-white" />
                        <span class="text-lg">{{ config('app.name') }}</span>
                    </a>

                    <div class="flex items-center gap-4">
                        <flux:link :href="route('login')" size="md">Sign in</flux:link>
                        <flux:button :href="route('register')" variant="primary">Get Started</flux:button>
                    </div>
                </div>
            </header>

            <main class="flex-1">
                <section class="py-24 sm:py-32">
                    <div class="mx-auto max-w-4xl px-6 text-center sm:px-8 lg:px-12">
                        <flux:heading size="5xl" class="font-extrabold">
                            Secure Password & Credit Card Management for Teams and Individuals
                        </flux:heading>

                        <flux:text class="mt-6 text-xl leading-relaxed text-zinc-600 dark:text-zinc-400">
                            Your Digital Vault, Reinvented. The secure, intuitive solution for managing your most sensitive information. Whether you're a solo user, a small business owner, or leading a team, we make protecting your passwords and credit cards simple, beautiful, and completely secure.
                        </flux:text>

                        <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                            <flux:button :href="route('register')" variant="primary">
                                Get Started Free
                            </flux:button>
                            <flux:button :href="route('login')" variant="ghost">
                                Sign In
                            </flux:button>
                        </div>
                    </div>
                </section>

                <section class="bg-zinc-50 py-16 dark:bg-zinc-900">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5">
                            <div class="flex flex-col items-center text-center sm:items-start sm:text-left">
                                <div class="flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.shield-check class="size-6 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="lg">Peace of mind</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">Military-grade encryption protects everything you store</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center sm:items-start sm:text-left">
                                <div class="flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.users class="size-6 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="lg">Team collaboration</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">Share credentials securely with your team</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center sm:items-start sm:text-left">
                                <div class="flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.sparkles class="size-6 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="lg">Modern experience</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">Beautiful, intuitive interface that just works</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center sm:items-start sm:text-left">
                                <div class="flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.lock-closed class="size-6 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="lg">Zero compromise</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">Multi-factor authentication and encrypted storage</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center sm:items-start sm:text-left">
                                <div class="flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.device-phone-mobile class="size-6 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="lg">Works everywhere</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">Progressive Web App for desktop and mobile</flux:text>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-24">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Features That Make Life Easier</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                Everything you need to manage passwords, credit cards, and teams in one place.
                            </flux:text>
                        </div>

                        <div class="mt-16 space-y-12">
                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-4">
                                    <div class="flex size-12 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <flux:icon.key class="size-6 text-zinc-700 dark:text-zinc-300" />
                                    </div>
                                    <flux:heading size="2xl">Password Management</flux:heading>
                                </div>

                                <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                    <div>
                                        <flux:heading class="mb-2" size="lg">Store with Confidence</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Save unlimited passwords with names, usernames, websites, and rich notes. Automatically fetch website favicons. Copy passwords, usernames, and URLs with one click.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Generate Strong Passwords</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Create 18-character secure passwords with a single click. Never reuse passwords or struggle to invent new ones again.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Smart Autocomplete</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Username suggestions based on your existing entries. Cardholder name autocomplete for faster credit card entry.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Find Anything Fast</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Real-time search across all your passwords and credit cards. Results appear instantly as you type.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Rich Notes with Formatting</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Integrated Tiptap editor for beautiful, formatted notes. Perfect for storing security questions, recovery codes, or additional context.
                                        </flux:text>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-4">
                                    <div class="flex size-12 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <flux:icon.document-check class="size-6 text-zinc-700 dark:text-zinc-300" />
                                    </div>
                                    <flux:heading size="2xl">Credit Card Management</flux:heading>
                                </div>

                                <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                    <div>
                                        <flux:heading class="mb-2" size="lg">Secure Card Storage</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Store cardholder names, card numbers, expiry dates, and CVV. Automatic brand detection for Visa, Mastercard, and Amex.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Automatic Brand Recognition</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Automatically detects Visa, Mastercard, and Amex cards and fetches their logos. Smart input formatting for different card types.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Smart Expiry Validation</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Never save expired cards. Clear expiry date display and notifications when cards are about to expire.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Quick Access</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            One-click copy for card numbers, CVV, expiry dates, and names. Masked display protects your privacy.
                                        </flux:text>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-4">
                                    <div class="flex size-12 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <flux:icon.users class="size-6 text-zinc-700 dark:text-zinc-300" />
                                    </div>
                                    <flux:heading size="2xl">Team Collaboration</flux:heading>
                                </div>

                                <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                    <div>
                                        <flux:heading class="mb-2" size="lg">Built for Teams</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Create and manage multiple teams. Invite team members via email. Switch between teams effortlessly.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Control Access</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Team members can only access their own team's data. Built-in authorization policies keep information isolated.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Manage Memberships</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Add, remove, and manage team members. View all active team members at a glance.
                                        </flux:text>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-4">
                                    <div class="flex size-12 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <flux:icon.shield-check class="size-6 text-zinc-700 dark:text-zinc-300" />
                                    </div>
                                    <flux:heading size="2xl">Authentication & Security</flux:heading>
                                </div>

                                <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                    <div>
                                        <flux:heading class="mb-2" size="lg">Multi-Layer Protection</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Two-Factor Authentication (2FA), Email Verification, Password Confirmation, and Secure Password Reset flows.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Encrypted Everything</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            AES-256-CBC encryption for all sensitive data. Passwords, credit card numbers, CVV codes, and notes are encrypted at rest.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Session Management</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            View and manage all active devices. Generate temporary login links. QR code login for mobile devices.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">API Access</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Generate secure API tokens for programmatic access. Perfect for automation and integrations.
                                        </flux:text>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-4">
                                    <div class="flex size-12 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <flux:icon.device-phone-mobile class="size-6 text-zinc-700 dark:text-zinc-300" />
                                    </div>
                                    <flux:heading size="2xl">User Experience</flux:heading>
                                </div>

                                <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                    <div>
                                        <flux:heading class="mb-2" size="lg">Progressive Web App</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Install on desktop, laptop, tablet, and mobile. Works like a native app with offline capabilities.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Beautiful Themes</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Light mode for bright environments, dark mode for late-night work. Seamless switching between themes.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Device-Friendly Login</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Scan a QR code to log in on your phone. Generate temporary login links for quick device access.
                                        </flux:text>
                                    </div>

                                    <div>
                                        <flux:heading class="mb-2" size="lg">Profile Management</flux:heading>
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">
                                            Upload profile photos. Update name and email. Change password. Delete your account when you're ready.
                                        </flux:text>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-zinc-50 py-24 dark:bg-zinc-900">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Who Is This For?</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                Built for individuals and teams who need secure, reliable password and credential management.
                            </flux:text>
                        </div>

                        <div class="mt-16 grid gap-8 lg:grid-cols-2">
                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <flux:heading size="2xl">For Individuals</flux:heading>
                                <div class="mt-6 space-y-4">
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Digital Minimalists</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">One secure place to store everything without the hassle.</flux:text>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Privacy Advocates</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Your data is encrypted end-to-end. We never see your passwords.</flux:text>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Freelancers & Consultants</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Manage client credentials, credit cards, and project access in one place.</flux:text>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Security-Conscious Users</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Strong passwords, 2FA, and data encryption — we've got you covered.</flux:text>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <flux:heading size="2xl">For Teams & Small Businesses</flux:heading>
                                <div class="mt-6 space-y-4">
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Small Teams</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Share passwords for shared accounts without emailing them insecurely.</flux:text>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Agencies & Consultancies</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Manage client credentials per project or per team.</flux:text>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Family Offices</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Securely store family passwords, credit cards, and financial information.</flux:text>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-zinc-700 dark:text-zinc-300" />
                                        <div>
                                            <flux:heading size="lg">Startups & Remote Teams</flux:heading>
                                            <flux:text class="mt-1 text-zinc-600 dark:text-zinc-400">Get started quickly with team collaboration built-in.</flux:text>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-24">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Security Built From the Ground Up</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                Every piece of sensitive information is encrypted using AES-256-CBC — the same standard used by banks and governments.
                            </flux:text>
                        </div>

                        <div class="mt-16 grid gap-8 sm:grid-cols-3">
                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.lock-closed class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="xl">AES-256 Encryption</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Military-grade encryption protects your passwords, credit cards, and notes at rest and in transit.
                                </flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.shield-check class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="xl">End-to-End Protection</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Team-based isolation ensures users can only access their team's data. No cross-team data leakage.
                                </flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.cloud-arrow-up class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:heading class="mt-4" size="xl">Regular Backups</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Automatic daily backups ensure your data is always safe and recoverable.
                                </flux:text>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-zinc-50 py-24 dark:bg-zinc-900">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Use Cases</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                See how antihq/password solves real-world challenges.
                            </flux:text>
                        </div>

                        <div class="mt-16 grid gap-8 sm:grid-cols-2">
                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-3">
                                    <flux:icon.building-storefront class="size-8 text-zinc-700 dark:text-zinc-300" />
                                    <flux:heading size="xl">Marketing Agency</flux:heading>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Problem:</span> 15 employees need access to 50+ client accounts across social media, Google Ads, web hosting, and email platforms.
                                    </flux:text>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Solution:</span> Create teams per client or per project. Invite team members to relevant teams. Store all client passwords securely. When employees leave, remove access with one click.
                                    </flux:text>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-3">
                                    <flux:icon.building-office class="size-8 text-zinc-700 dark:text-zinc-300" />
                                    <flux:heading size="xl">Small Business Owner</flux:heading>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Problem:</span> Managing personal passwords, business accounts, shared team passwords, and credit cards across multiple devices.
                                    </flux:text>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Solution:</span> Create personal and business teams. Store credit cards securely. Install as PWA on all devices. Use QR code login on mobile.
                                    </flux:text>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-3">
                                    <flux:icon.users class="size-8 text-zinc-700 dark:text-zinc-300" />
                                    <flux:heading size="xl">Family with Shared Services</flux:heading>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Problem:</span> Family needs shared access to streaming services, utilities, and financial accounts while keeping some information private.
                                    </flux:text>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Solution:</span> Create family team for shared accounts. Create personal teams for individual members. Parents can manage family accounts with controlled access.
                                    </flux:text>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <div class="flex items-center gap-3">
                                    <flux:icon.rocket-launch class="size-8 text-zinc-700 dark:text-zinc-300" />
                                    <flux:heading size="xl">Development Shop</flux:heading>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Problem:</span> Multiple clients, multiple environments, multiple teams — too many credentials to manage securely.
                                    </flux:text>
                                </div>
                                <div class="mt-4">
                                    <flux:text class="text-zinc-600 dark:text-zinc-400">
                                        <span class="font-semibold">Solution:</span> Create teams per client or per project. Store environment credentials and API keys in notes. Share access with relevant developers.
                                    </flux:text>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-24">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Built on Proven Technology</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                antihq/password is built on a foundation of battle-tested technologies: Laravel, comprehensive testing, modern security practices, and continuous updates.
                            </flux:text>
                        </div>
                    </div>
                </section>

                <section class="bg-zinc-50 py-24 dark:bg-zinc-900">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">What Makes antihq/password Different?</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                Compare us with typical password managers and browser password managers.
                            </flux:text>
                        </div>

                        <div class="mt-16 overflow-x-auto">
                            <flux:table>
                                <flux:table.columns>
                                    <flux:table.column>Feature</flux:table.column>
                                    <flux:table.column>antihq/password</flux:table.column>
                                    <flux:table.column>Typical Managers</flux:table.column>
                                    <flux:table.column>Browser Managers</flux:table.column>
                                </flux:table.columns>
                                <flux:table.rows>
                                    <flux:table.row>
                                        <flux:table.cell>Password Management</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-yellow-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>Credit Card Management</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>Team Collaboration</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>Rich Text Notes</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-yellow-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>QR Code Login</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>Beautiful UI</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-yellow-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-yellow-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>PWA Support</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-yellow-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>2FA Support</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.x-mark class="size-5 text-red-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                    <flux:table.row>
                                        <flux:table.cell>Search</flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-green-600" />
                                        </flux:table.cell>
                                        <flux:table.cell>
                                            <flux:icon.check class="size-5 text-yellow-600" />
                                        </flux:table.cell>
                                    </flux:table.row>
                                </flux:table.rows>
                            </flux:table>
                        </div>
                    </div>
                </section>

                <section class="py-24">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Everything You Need</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                All features included out of the box. No hidden fees or surprise charges.
                            </flux:text>
                        </div>

                        <div class="mt-16 grid gap-8 lg:grid-cols-2">
                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <flux:heading size="2xl">Included Out of the Box</flux:heading>
                                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Password management</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Credit card management</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Team creation</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Rich text notes</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>2FA</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Email verification</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Password reset</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Device management</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>API tokens</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>PWA support</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Light & dark themes</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>QR code login</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Temporary links</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.check class="size-5 shrink-0 text-green-600" />
                                        <flux:text>Real-time search</flux:text>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <flux:heading size="2xl">What You Won't Find</flux:heading>
                                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                    <div class="flex items-center gap-3">
                                        <flux:icon.x-mark class="size-5 shrink-0 text-red-600" />
                                        <flux:text>Data limits</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.x-mark class="size-5 shrink-0 text-red-600" />
                                        <flux:text>Storage quotas</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.x-mark class="size-5 shrink-0 text-red-600" />
                                        <flux:text>Complicated setup</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.x-mark class="size-5 shrink-0 text-red-600" />
                                        <flux:text>Clunky interfaces</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.x-mark class="size-5 shrink-0 text-red-600" />
                                        <flux:text>Hidden fees</flux:text>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <flux:icon.x-mark class="size-5 shrink-0 text-red-600" />
                                        <flux:text>Weakened security</flux:text>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-zinc-50 py-24 dark:bg-zinc-900">
                    <div class="mx-auto max-w-4xl px-6 text-center sm:px-8 lg:px-12">
                        <flux:heading size="5xl">Ready to Secure Your Digital Life?</flux:heading>
                        <flux:text class="mt-6 text-xl text-zinc-600 dark:text-zinc-400">
                            antihq/password is more than just a password manager — it's a complete vault for your team's digital identity.
                        </flux:text>

                        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="rounded-lg bg-white p-6 dark:bg-zinc-900">
                                <flux:heading size="lg">For Individuals</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Stop using the same password everywhere. Generate strong passwords. Access on any device.
                                </flux:text>
                            </div>

                            <div class="rounded-lg bg-white p-6 dark:bg-zinc-900">
                                <flux:heading size="lg">For Teams</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Share credentials securely. Manage access centrally. Remove ex-employees instantly.
                                </flux:text>
                            </div>

                            <div class="rounded-lg bg-white p-6 dark:bg-zinc-900">
                                <flux:heading size="lg">For Everyone</flux:heading>
                                <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
                                    Always encrypted. Zero technical setup. Beautiful experience.
                                </flux:text>
                            </div>
                        </div>

                        <div class="mt-12">
                            <flux:button :href="route('register')" variant="primary">
                                Sign Up Today
                            </flux:button>
                        </div>
                    </div>
                </section>

                <section class="py-24">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">Works Where You Work</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                Available on desktop, laptop, tablet, and mobile.
                            </flux:text>
                        </div>

                        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.computer-desktop class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:text class="mt-4 font-semibold">Desktop & Laptop</flux:text>
                                <flux:text class="text-sm text-zinc-600 dark:text-zinc-400">Windows, macOS, Linux</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.device-phone-mobile class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:text class="mt-4 font-semibold">Mobile</flux:text>
                                <flux:text class="text-sm text-zinc-600 dark:text-zinc-400">iOS & Android</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.device-tablet class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:text class="mt-4 font-semibold">Tablet</flux:text>
                                <flux:text class="text-sm text-zinc-600 dark:text-zinc-400">iPad & Android tablets</flux:text>
                            </div>

                            <div class="flex flex-col items-center text-center">
                                <div class="flex size-16 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                    <flux:icon.globe-alt class="size-8 text-zinc-700 dark:text-zinc-300" />
                                </div>
                                <flux:text class="mt-4 font-semibold">Web</flux:text>
                                <flux:text class="text-sm text-zinc-600 dark:text-zinc-400">All major browsers</flux:text>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-zinc-50 py-24 dark:bg-zinc-900">
                    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl text-center">
                            <flux:heading size="4xl">We Protect Your Data</flux:heading>
                            <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                                Your security and privacy are our top priorities.
                            </flux:text>
                        </div>

                        <div class="mt-16 grid gap-8 lg:grid-cols-2">
                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <flux:heading size="2xl">Our Security Promise</flux:heading>
                                <div class="mt-6 space-y-4">
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">End-to-end encryption — Your data is encrypted at rest and in transit</flux:text>
                                    </div>
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">Regular backups — We automatically backup your data daily</flux:text>
                                    </div>
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">Security monitoring — We actively monitor for threats and vulnerabilities</flux:text>
                                    </div>
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">Compliance ready — Built with security best practices in mind</flux:text>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-900">
                                <flux:heading size="2xl">Your Data Ownership</flux:heading>
                                <div class="mt-6 space-y-4">
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">Export anytime — Take your data with you whenever you want</flux:text>
                                    </div>
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">Delete on request — We delete your data permanently when you close your account</flux:text>
                                    </div>
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">Transparent policies — We're clear about how we handle your data</flux:text>
                                    </div>
                                    <div class="flex gap-3">
                                        <flux:icon.check-circle class="mt-1 size-5 shrink-0 text-green-600" />
                                        <flux:text class="text-zinc-600 dark:text-zinc-400">No sharing — We never share your data with third parties for marketing or advertising</flux:text>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-24">
                    <div class="mx-auto max-w-4xl px-6 text-center sm:px-8 lg:px-12">
                        <flux:heading size="4xl">Need Help?</flux:heading>
                        <flux:text class="mt-4 text-xl text-zinc-600 dark:text-zinc-400">
                            Questions? We're here for you.
                        </flux:text>

                        <div class="mt-12 flex flex-wrap justify-center gap-8">
                            <div>
                                <flux:icon.envelope class="mx-auto size-8 text-zinc-700 dark:text-zinc-300" />
                                <flux:text class="mt-2 block font-semibold">Email Support</flux:text>
                                <flux:link href="mailto:support@antihq.com">support@antihq.com</flux:link>
                            </div>

                            <div>
                                <flux:icon.book-open class="mx-auto size-8 text-zinc-700 dark:text-zinc-300" />
                                <flux:text class="mt-2 block font-semibold">Help Documentation</flux:text>
                                <flux:link href="#">View Docs</flux:link>
                            </div>

                            <div>
                                <flux:icon.bug-ant class="mx-auto size-8 text-zinc-700 dark:text-zinc-300" />
                                <flux:text class="mt-2 block font-semibold">Report Bugs</flux:text>
                                <flux:link href="#">File Issue</flux:link>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-zinc-200 bg-zinc-50 py-12 dark:border-zinc-800 dark:bg-zinc-900">
                <div class="mx-auto max-w-7xl px-6 text-center sm:px-8 lg:px-12">
                    <div class="flex items-center justify-center gap-2">
                        <x-app-logo-icon class="size-6 fill-current text-zinc-700 dark:text-zinc-300" />
                        <span class="font-semibold text-zinc-700 dark:text-zinc-300">{{ config('app.name') }}</span>
                    </div>

                    <flux:text class="mt-4 text-sm text-zinc-600 dark:text-zinc-400">
                        is designed, built, and backed by
                        <flux:link href="https://x.com/oliverservinX" :accent="false">Oliver Servín</flux:link>.
                    </flux:text>

                    <flux:text class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        Need help? Send an email to
                        <flux:link href="mailto:oliver@antihq.com" :accent="false">oliver@antihq.com</flux:link>.
                    </flux:text>
                </div>
            </footer>
        </div>

        @fluxScripts
    </body>
</html>
