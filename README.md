# Storak Vendor Panel

**Laravel 8 Blade** vendor dashboard for the Storak multi-vendor e-commerce marketplace. Vendors manage their store, product listings (with variants, translations, CSV bulk upload), orders, coupon codes, Q&A, reviews, and receive real-time notifications. All data fetched from the Storak backend API via Unirest HTTP.

![PHP](https://img.shields.io/badge/PHP-7.3%2B-777BB4?style=flat&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=flat&logo=laravel)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap)
![Pusher](https://img.shields.io/badge/Pusher-Realtime-300D4F?style=flat&logo=pusher)
![Twilio](https://img.shields.io/badge/Twilio-SMS-F22F46?style=flat&logo=twilio)
![DomPDF](https://img.shields.io/badge/DomPDF-PDF_Invoices-CC0000?style=flat)
![Maatwebsite Excel](https://img.shields.io/badge/Maatwebsite-Excel_Import-green?style=flat)

## Features

- **Dashboard** — total orders, delivered orders, products count, coupons, profile completion, recent notifications
- **Product Management** — CRUD with multi-image upload, 3-level category selection (AJAX), brand, variants (attribute/value matrix), product translations, CSV bulk upload, status toggle
- **Order Management** — listing, status updates (pipeline), PDF invoices, email notifications on order placement
- **Coupon Management** — CRUD, enable/disable toggle
- **Q&A & Reviews** — view and reply to customer questions and reviews per product
- **Store Settings** — edit account and store profile
- **Notifications** — Pusher real-time notifications; mark as read
- **Sub-accounts** — role and user management scoped to vendor

## Architecture

All data via `Unirest\Request` HTTP calls to `config('app.url') . 'api/vendor/...'`. Auth token stored in session, sent as `Authorization` header. Tightly coupled to the Storak backend API.

## Getting Started

```bash
composer install
cp .env.example .env && php artisan key:generate
# Set APP_URL to the Storak backend API URL, PUSHER_APP_*, TWILIO_*
php artisan migrate && php artisan serve
```

## License
MIT
