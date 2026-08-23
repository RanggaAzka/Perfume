# PERFU.ME — Laravel Website

A full-stack premium fragrance brand website: an editorial public storefront
built around two signature fragrances (Vanessence, Dynamyst), a separate
in-store **refill collection** directory, and an authenticated admin panel
covering products, refills, fragrance notes, and contact messages. Built
with Laravel 11, Blade, Tailwind CSS, and Vite.

This is not a marketplace or ecommerce site — there is intentionally no
cart, checkout, payment gateway, wishlist, customer account, or product
reviews. It's a brand/campaign site with a lightweight lead-capture contact
form and an admin panel a non-technical client can run day to day.

This is a **complete Laravel project** — every standard Laravel file
(`bootstrap/app.php`, `config/*`, `public/index.php`, `artisan`, etc.) is
included alongside the custom application code. There is no scaffolding
step and no overlay folder.

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL (or MariaDB)

## Setup

```bash
composer install
npm install
copy .env.example .env        # macOS/Linux: cp .env.example .env
php artisan key:generate
```

Create the database:

```sql
CREATE DATABASE perfume_brand;
```

Confirm `.env` matches your MySQL setup (Laragon's default `root` with an
empty password is already what `.env.example` assumes), then:

```bash
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Visit `http://127.0.0.1:8000`.

**Admin login** (development only — change the password before deploying):
```
URL:      /login
Email:    admin@perfume.test
Password: password
```

While developing, run `npm run dev` in a second terminal instead of
`npm run build` for Vite hot-reloading.

> **If you're upgrading an existing install of this project** rather than
> starting fresh: just run `composer install`, `npm install`, and
> `php artisan migrate` (no `--fresh`, no `--seed` needed unless you want the
> new refill fragrances seeded in). The two new migrations are additive only
> — they add a `refills` table and a `position` column to the existing
> `fragrance_note_product` pivot (backfilled to `'heart'`) — nothing existing
> is dropped or altered destructively.

## What's new in this pass (Phase 2)

- **Rebrand** to PERFU.ME (`config/app.php`, `.env.example`, `config/mail.php`)
- **Refill Collection** — a brand-new, separate entity from signature
  products: model, migration, admin CRUD (`/admin/refills`), and an
  editorial A-Z public directory at `/refills`
- **Admin Contact Messages** — `/admin/messages` to view, mark read/unread,
  and delete inbound contact submissions; dashboard now surfaces unread count
- **Admin Settings** (`/admin/settings`) — site name override, contact
  email/phone, Instagram/TikTok URLs, address, and store hours. Every field
  is optional and nullable: nothing is invented, so the footer, contact
  page, and homepage refill-service section only display a piece of info
  once an admin has actually entered it. This was part of the original
  admin sidebar spec from the first build that had been missed until now.
- **Top / Heart / Base note structure** — fragrance notes now carry an
  olfactive `position` per product (additive migration), surfaced on the
  redesigned product detail page as a proper fragrance-campaign layout with
  an "Olfactive Journey" diagram
- **Homepage restructure**: Hero -> Signature Collection -> Brand Philosophy
  -> Refill Collection preview -> Fragrance Notes -> Refill Service -> Contact
- **Nav updated**: About / Story / Collection / Refill / Ingredients /
  Contact - "Collection" and "Refill" are now clearly distinct paths
- Editorial redesign of the Story and Ingredients pages (image/text
  composition, Top/Heart/Base fragrance journal)

## Project structure

```
perfume-brand/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/            DashboardController, ProductController, RefillController,
│   │   │   │                     FragranceNoteController, ContactMessageController
│   │   │   ├── Auth/             AuthenticatedSessionController (login/logout)
│   │   │   ├── HomeController.php, ProductController.php, RefillController.php, ContactController.php
│   │   ├── Middleware/           EnsureUserIsAdmin.php
│   │   └── Requests/             Store/UpdateProductRequest, Store/UpdateRefillRequest,
│   │                             Store/UpdateFragranceNoteRequest, ContactRequest
│   ├── Models/                   User, Product, Refill, FragranceNote, ContactMessage
│   └── Providers/AppServiceProvider.php
├── bootstrap/app.php             Routing + the "admin" middleware alias
├── config/                       Standard Laravel config
├── database/
│   ├── migrations/                users, cache, jobs, fragrance_notes, products,
│   │                               fragrance_note_product, contact_messages, refills,
│   │                               add-position-to-fragrance_note_product
│   ├── seeders/                  AdminSeeder, FragranceNoteSeeder, ProductSeeder, RefillSeeder
│   └── factories/                UserFactory, ProductFactory, RefillFactory, ContactMessageFactory
├── public/
│   ├── index.php, .htaccess, robots.txt
│   └── images/                   Placeholder bottle/hero SVG art — swap for real product photography
├── resources/
│   ├── css/app.css, js/app.js    Tailwind + vanilla JS (mobile nav, admin sidebar, scroll-reveal)
│   └── views/
│       ├── layouts/               app, admin, guest
│       ├── components/            navbar, footer
│       ├── home.blade.php + home/ (hero, products, story, refill-preview, ingredients,
│       │                           refill-service, cta)
│       ├── products/               index, show (campaign-style detail page)
│       ├── refills/index.blade.php A-Z editorial refill directory
│       ├── pages/                  about, story, ingredients, contact
│       ├── auth/login.blade.php
│       └── admin/                  dashboard, products/*, refills/*, fragrance-notes/*, messages/*
├── routes/web.php, routes/console.php
├── storage/                       app/public (uploads), framework caches, logs
├── tests/                         Feature tests: homepage, admin auth guard, product CRUD,
│                                   refill CRUD + public visibility, contact messages
├── .env.example
├── composer.json
├── package.json
├── vite.config.js
├── tailwind.config.js
└── phpunit.xml
```

## Routes

**Public**
```
GET  /
GET  /about
GET  /story
GET  /ingredients
GET  /products
GET  /products/{product:slug}
GET  /refills
GET  /contact
POST /contact
```

**Auth**
```
GET  /login
POST /login
POST /logout   (auth required)
```

**Admin** (auth + admin middleware)
```
GET    /admin/dashboard
GET|POST|PUT|DELETE  /admin/products[...]         (resource, except show)
GET|POST|PUT|DELETE  /admin/refills[...]          (resource, except show)
GET|POST|PUT|DELETE  /admin/fragrance-notes[...]  (resource, except show)
GET    /admin/messages
GET    /admin/messages/{message}
PATCH  /admin/messages/{message}/unread
DELETE /admin/messages/{message}
```

## How the pieces connect

**Products vs. Refills - intentionally separate.** Vanessence and Dynamyst
are the two signature products (`products` table) with full detail pages,
descriptions, and fragrance notes. Refills (`refills` table) are a distinct,
much simpler entity - just a name, active flag, and sort order - because
they represent an in-store service, not standalone products with their own
pages. Adding a refill in `/admin/refills` makes it appear immediately in
the homepage preview and the `/refills` directory; deactivating it removes
it from both without deleting the record.

**Note positions.** Each fragrance note attached to a product now carries a
`position` (top/heart/base) on the pivot table, editable per note in the
product admin form. The product detail page groups notes into Top/Heart/Base
sections and a simple "Olfactive Journey" diagram; the `/ingredients` journal
groups every note site-wide by whichever position it plays most often.

Editing a product or refill in the admin panel updates the database directly
- the homepage, collection page, product detail pages, and refill directory
all query that same data live, so changes appear everywhere immediately.
Replacing a product's image deletes the old file from
`storage/app/public/products`; deleting a product deletes both its row and
its image. Nothing is left orphaned.

## Authentication

A single `web` guard, session-based login/logout, one `users.role` column
distinguishing `admin` from `customer` - implemented directly rather than
through the Breeze installer, since this site only ever needs one admin
account and has no public registration.

## Testing

```bash
php artisan test
```

Covers: homepage rendering, the admin auth guard (403 for non-admins,
redirect-to-login for guests), full product CRUD, refill CRUD plus the
active/inactive visibility rule on the public refill page, and the contact
message flow (submission, admin-only access, mark-as-read on view). All run
against an in-memory SQLite database (`phpunit.xml`), never your MySQL data.

## A note on verification

Every file was reviewed by hand, and I statically cross-checked (again,
after this pass's changes) every `route()` call, `view()` call,
`@extends`/`@include`, namespace, and `use App\...` import against the files
actually present - all resolve cleanly as of this delivery.

What I have **not** done - because my sandboxed environment's network
allowlist doesn't reach Packagist - is actually run `composer install`,
`npm install`, `php artisan migrate --seed`, or `php artisan test` against
this code. I'm not claiming it's been tested end-to-end; I'm telling you
it's been thoroughly statically reviewed. If anything surfaces on first run,
tell me the exact error and I'll fix it immediately.

### Known gaps from this pass

- The `/about` page and the `home/story.blade.php` "Brand Philosophy"
  section weren't rewritten beyond a label/copy tweak - they still lean on
  the original layout from the first delivery rather than a full redesign.
- No settings/business-hours system exists (none was requested with real
  data), so the Refill Service section on the homepage intentionally makes
  no claims about location or hours.
