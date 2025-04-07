# Laravel Project Installation Guide
## 1. Clone the Repository
```sh
git clone https://github.com/abduljaleel-alwli/university-management-system.git
cd university-management-system
```
## 2. Install dependencies
```sh
composer install
npm install
```
## 3. Setting up the environment file
```sh
copy .env.example .env
```
Then open the `.env` file and update the following settings:
### Database setup:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=
```
### Mailer setup:
```
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=your_domain_mailer
MAIL_PORT=your_port
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
## 4. Generate application key
```sh
php artisan key:generate
```
## 5. Implementation of transfers
```sh
php artisan migrate
```
## 6. Enter default data
```sh
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=AssignSuperAdminSeeder
```
## 7. Preparing assets
```sh
npm run build
```
## 8. Run the application
```sh
php artisan serve
