# دليل تثبيت مشروع Laravel

## 1. استنساخ المستودع
```sh
git clone https://github.com/abduljaleel-alwli/university-management-system.git
cd university-management-system
```

## 2. تثبيت التبعيات
```sh
composer install
npm install
```

## 3. إعداد ملف البيئة
```sh
copy .env.example .env
```

ثم قم بفتح ملف `.env` وتحديث الإعدادات التالية:

### إعداد قاعدة البيانات:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=
```

### إعداد البريد الإلكتروني:
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

## 4. توليد مفتاح التطبيق
```sh
php artisan key:generate
```

## 5. تنفيذ الترحيلات
```sh
php artisan migrate
```

## 6. إدخال البيانات الافتراضية
```sh
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=AssignSuperAdminSeeder
```

## 7. تجهيز الأصول
```sh
npm run build
```

## 8. تشغيل التطبيق
```sh
php artisan serve
