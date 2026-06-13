# Multi-Vendor eCommerce — Vendor Portal

> **Laravel 8 Blade** self-service portal for marketplace vendors. Vendors manage their product catalog, orders, coupons, and store settings. Includes social OAuth login, Twilio SMS OTP verification, CSV product import, and real-time Pusher notifications.

![Laravel](https://img.shields.io/badge/Laravel-8-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.0-777BB4?style=flat-square&logo=php&logoColor=white)
![Twilio](https://img.shields.io/badge/Twilio-SMS-F22F46?style=flat-square&logo=twilio&logoColor=white)
![Pusher](https://img.shields.io/badge/Pusher-Real--time-300D4F?style=flat-square&logo=pusher&logoColor=white)

---

## Architecture

Same API-proxy pattern as the admin panel — all business logic lives in `ecommerence-api`.

```
Vendor Browser
  |
  v
Vendor Portal (this repo — Laravel 8 Blade)
  |  All data via Unirest HTTP calls
  v
ecommerence-api (Laravel 8 REST API)
  |
  v
MySQL Database
```

---

## Tech Stack

| Package | Version | Purpose |
|---|---|---|
| `laravel/framework` | ^8.40 | Core framework |
| `laravel/socialite` | ^5.2 | Google/social OAuth login |
| `twilio/sdk` | ^6.25 | SMS OTP for phone verification + password reset |
| `intervention/image` | ^2.6 | Image upload and resize |
| `maatwebsite/excel` | ^3.1 | CSV bulk product import/export |
| `barryvdh/laravel-dompdf` | ^0.9.0 | PDF invoice generation |
| `h4cc/wkhtmltopdf-amd64` | 0.12.x | HTML to PDF rendering |
| `ckeditor/ckeditor` | ^4.16 | Rich text for product descriptions |
| `laraveldaily/laravel-invoices` | ^2.0 | Invoice PDF |
| `mashape/unirest-php` | ^3.0 | API proxy HTTP calls |

---

## Route Structure

All routes under `/vendor/*` prefix, protected by `isVendor` middleware.

| Module | Routes |
|---|---|
| Auth | Login, register, email verification, mobile OTP (Twilio), social OAuth (Socialite) |
| Password Reset | Via email link + via mobile OTP |
| Dashboard | `GET /vendor/dashboard` |
| Products | Resource + variant CRUD, status toggle, AR/EN translation, CSV import, image management |
| Product Q&A | Global + per-product lists + reply |
| Product Reviews | Global + per-product lists + reply |
| Orders | Resource + status update + invoice |
| Coupons | Resource + status toggle |
| Store | Resource (store profile, holiday mode config) |
| Notifications | Recent + all + mark-read |
| Commission | View structure + index |
| Account Settings | Edit + update |
| Users & Roles | RBAC for vendor sub-users |
| Ajax | Chained selects: categories → subcategories → childcategories → brands → attributes → variants |

---

## Database Schema (Canonical — 22 migrations)

| Table | Key Columns |
|---|---|
| `users` | id, name, email, password |
| `stores` | user_id, store_name, tag_line, category_id, logo, cover, `holiday_mode`, `holiday_start_date`, `holiday_end_date` |
| `bank_accounts` | user_id, account_title, account_no, bank_name, branch_code, iban, bank_letter_doc |
| `products` | store_id, brand_id, category_id, subcategory_id, childcategory_id, name, description, total_stock, remaining_stock, primary_image, video_url (softDeletes) |
| `products_variants` | product_id, attribute_id, variant_id, retail_price, sale_price, sku, stock |
| `products_images` | product_id, image_path |
| `products_questions` | product_id, user_id, question, answer, status |
| `products_reviews` | product_id, user_id, review, rating, status |
| `categories` / `sub_categories` / `child_categories` | 3-level hierarchy |
| `brands` | id, name |
| `attributes` / `variants` | attribute-variant system |
| `wishlists` | user_id, product_id |
| `banners` | title, image, status |
| `cities` | id, name |
| `custom_s_m_s` | SMS log entries |

---

## Key Features

- **Multi-step vendor onboarding** — basic info → business info → store info → documents → bank details → warehouse → submit for review
- **Social login** — Google OAuth via Socialite
- **Twilio SMS OTP** — phone number verification during registration + SMS-based password reset
- **Holiday mode** — vendors configure store closure dates
- **Coupon management** — discount codes with status toggle
- **Bilingual products** — Arabic + English content per product
- **Real-time notifications** — Pusher broadcasts new order/status events to vendor browser
- **CSV bulk import** — upload product catalog via Excel
- **RBAC** — vendor sub-user roles and permissions

---

## Related Repositories

| Repo | Purpose |
|---|---|
| `ecommerence-api` | Laravel 8 REST API backend |
| `ecommerence-admin` | Super-admin panel |
| `ecommerce-website` | Customer-facing storefront |
