# MoonSpringRolls Automation Trigger Email
This is a simple project showing automation to trigger email by crawling data from google sheet by using Google Sheet API.

---

## What It Does
- Syncs parcel info from a Google Sheet to a local database.  
- Shows all parcels and their status in a simple dashboard.  
- Sends email notifications for Out For Delivery (OFD) parcels.  
- Two buttons on the dashboard:
  1. **Sync Spreadsheet** – updates your local DB from Google Sheets **without sending any emails**.  
  2. **Send OFD Emails** – sends emails only to parcels with `Out For Delivery` status that haven’t been notified yet.  

---

## Requirements
- **Backend:** Laravel 8/9 (PHP 8.5)  
- **Database:** MySQL  
- **Queue:** Laravel Queue (Sync driver by default)  
- **Mail:** Laravel Mail (Gmail SMTP)  
- **Google Sheets API:** `google/apiclient`  
- **Frontend:** Blade + Bootstrap  

---

## Getting Started
1. Clone the repo:
```bash
git clone https://github.com/natasyaazhar/MoonSpringRolls.git
cd MoonSpringRolls

2. Install dependencies:
```bash
composer install

3. Copy .env.example to .env:
```bash
cp .env.example .env

4. Generate the app key:
```bash
php artisan key:generate

5. Set folder permissions:
```bash
chmod -R 775 storage bootstrap/cache

6. Start the server:
```bash
php artisan serve

7. Visit http://127.0.0.1:8000 (ctrl+left click) to see the dashboard


---

## Environment Variables 
APP_NAME=MoonSpringRolls
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=moonspringrolls
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

GOOGLE_SHEET_ID=your_google_sheet_id_here ##For Gmail, you’ll need an App Password if 2FA is enabled


---

## Database
1. Create a MySQL database called moonspringrolls.

2. Run migration
```bash
php artisan migrate

3. Optional: add a test parcel:
```bash
php artisan tinker
>>> App\Models\ParcelUpdate::create([
... 'name' => 'Test User',
... 'email' => 'test@example.com',
... 'parcel_status' => 'Out For Delivery'
... ]);


---

## Google Sheets Setup
1. Create a Service Account in Google Cloud Console

2. Download the JSON credentials into storage/app/google/.

3. Share your Google Sheet with the service account email.

4. Set the Google_SHEET_ID in .env.

5. Test syncing:
```bash
php artisa parcel:sync        #Make sure your sheet has at least these columns: Name | Email | Parcel Status | Tracking Number


---

## Sending Emails
- Emails are sent using Laravel Mail + Gmail SMTP.
- Only parcels with parcel_status = Out For Delivery AND updated_at = null will get emails.
- Queue driver is sync, so emails send immediately when the job runs.


---

## Usage
- Open the dashboard (http://127.0.0.1:8000).
- Click Sync Spreadsheet to update DB from Google Sheets.
- Click Send OFD Emails to send emails to pending parcels.
- Timestamps show in human format using diffForHumans() (like “3 minutes ago”)





-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
