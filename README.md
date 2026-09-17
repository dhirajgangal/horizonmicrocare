# Horizonion Microcare

Website and Super Admin for **Horizonion Microcare Association**, a women-focused financial inclusion initiative. The public site publishes responsible loan information. The Super Admin manages that content, loan products, applications, and customer enquiries.

Submitting an enquiry or application **does not guarantee a loan**. Approval is decided by the organization, not by the website.

## What is included

### Public website

The public site is a branded marketing and information site (`/` through legal pages).

| Area | Status |
| --- | --- |
| Home, about, mission, contact, gallery | Live pages. About and mission are static. Gallery shows **active** images from Super Admin. Contact details come from Settings. |
| Offerings, how it works, eligibility, stories, FAQs, apply, track, grievance, careers, news, resources, legal | Routes are reserved. Most still show Phase 1 placeholders until CMS content is wired through. |

Public URLs include `/about-us`, `/loans`, `/gallery`, `/apply-loan`, `/track-application`, `/contact-us`, `/privacy-policy`, and `/terms`.

### Super Admin (`/admin`)

Filament panel for staff. Orange accent on primary actions and selected navigation; navy sidebar.

**Dashboard**
- Live counts for products, applications, inquiries, and stories
- Charts for application status, monthly volume, and product mix
- Tabbed recent applications, inquiries, and products
- Quick actions

**Loan management**
- Loan products with features, eligibility, required documents, and product FAQs
- Loan applications (New, Under Review, Approved, Rejected, Archived)
- Internal notes and private application documents
- Soft-delete archive for applications

**Website content**
- Home slides, statistics, sections, Why Choose Us, How It Works
- CMS pages and legal copy (About Us and Our Mission are static public pages, not CMS records)
- Leadership profiles
- Client stories
- Gallery categories and images (public disk, `/storage` URLs)
- Site-wide FAQs

**Customer management**
- Inquiries with status, notes, and export
- Application reports and CSV export

**Website settings**
- Organization name, logos, contact, social, SEO, consent text
- Header and footer navigation items

**Administration**
- Admin users and roles
- Activity log
- Reports

View and edit screens that have related records (applications, products, inquiries) use a single card with **Details** plus relation tabs.

## Roles

| Role | Access |
| --- | --- |
| Super Admin | Full access |
| Content Manager | CMS, navigation, stories, gallery, FAQs, leadership, view loans |
| Loan Manager | Loan products, applications, stories |
| Customer Support | Applications, inquiries, FAQs |
| Viewer | Dashboard plus read-only loans, applications, inquiries, and activity |

Inactive users cannot sign in.

## Tech stack

- PHP 8.3+ / Laravel 13
- Filament 4 and Livewire 3
- Spatie Permission and Activity Log
- Tailwind CSS 4, Alpine.js, Vite
- SQLite by default (`.env.example`); MySQL is also supported

Brand tokens live in `config/brand.php` (navy `#0B1F4A`, orange `#F15A24`).

## Local setup

```bash
composer setup
```

That installs PHP and JS dependencies, copies `.env` if needed, generates the app key, runs migrations, and builds frontend assets.

Or step by step:

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan storage:link
npm install
npm run build
php artisan db:seed
```

`storage:link` is required so logos and gallery images are reachable at `/storage/...`.

### Run the app

With Laravel Herd, open `http://horizonmicrocare.test`.

Or:

```bash
composer run dev
```

Then visit `APP_URL` from `.env` (default `http://localhost:8000`).

Admin: `{APP_URL}/admin`

## Seeded accounts

`php artisan db:seed` loads roles, settings, CMS placeholders, and dummy records for every admin module.

| Role | Email | Password |
| --- | --- | --- |
| Super Admin | `admin@horizonmicrocare.test` | `password` |
| Content Manager | `content@horizonmicrocare.test` | `password` |
| Loan Manager | `loans@horizonmicrocare.test` | `password` |
| Customer Support | `support@horizonmicrocare.test` | `password` |
| Viewer | `viewer@horizonmicrocare.test` | `password` |

Dummy amounts, stories, and statistics are for Super Admin review only. They are not public offers.

## Tests

```bash
php artisan test
```

PHPUnit feature tests cover public pages, admin access, loan/gallery CRUD, and seeders.

## Project layout

```
app/Filament/          Super Admin resources, pages, widgets
app/Http/Controllers/  Public home and content routes
app/Models/            Loans, applications, inquiries, CMS, gallery
app/Services/          Site settings
resources/views/       Public Blade pages and Filament custom views
public/css/            Admin theme and shared alert styles
database/seeders/      Roles, settings, CMS, dummy data
```
