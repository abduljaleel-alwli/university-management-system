<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// ---------------

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('Home'), route('home'));
});

// Panel
Breadcrumbs::for('panel', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Panel'), route('panel'));
});

// Login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Log in'), route('login'));
});

Breadcrumbs::for('password.request', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Forgot Password'), route('password.request'));
});

Breadcrumbs::for('verification.notice', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Email verification'), route('verification.notice'));
});

// ----> Profile
// مسار reset-password
Breadcrumbs::for('password.reset', function (BreadcrumbTrail $trail, $token) {
    $trail->parent('home'); // إذا كان لديك لوحة تحكم، يمكن أن تكون هذه المسار الأب
    $trail->push(__('Reset Password'), route('password.reset', ['token' => $token]));
});

// مسار sanctum/csrf-cookie
Breadcrumbs::for('sanctum.csrf-cookie', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('CSRF Cookie'), route('sanctum.csrf-cookie'));
});

// مسار storage/{path}
Breadcrumbs::for('storage.local', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Storage'), route('storage.local'));
});

// مسار two-factor-challenge
Breadcrumbs::for('two-factor.login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Two-Factor Authentication'), route('two-factor.login'));
});

// مسار user/confirm-password
Breadcrumbs::for('password.confirm', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Confirm Password'), route('password.confirm'));
});

// مسار user/confirmed-password-status
Breadcrumbs::for('password.confirmation', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Password Confirmation Status'), route('password.confirmation'));
});

// مسار user/confirmed-two-factor-authentication
Breadcrumbs::for('two-factor.confirm', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Confirmed Two-Factor Authentication'), route('two-factor.confirm'));
});

// مسار user/profile
Breadcrumbs::for('profile.show', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Profile'), route('profile.show'));
});

// مسار user/profile-information
Breadcrumbs::for('user-profile-information.update', function (BreadcrumbTrail $trail) {
    $trail->parent('profile.show');
    $trail->push(__('Update Profile Information'), route('user-profile-information.update'));
});

// مسار user/two-factor-authentication
Breadcrumbs::for('two-factor.enable', function (BreadcrumbTrail $trail) {
    $trail->parent('profile.show');
    $trail->push(__('Enable Two-Factor Authentication'), route('two-factor.enable'));
});

// مسار user/two-factor-qr-code
Breadcrumbs::for('two-factor.qr-code', function (BreadcrumbTrail $trail) {
    $trail->parent('profile.show');
    $trail->push(__('Two-Factor QR Code'), route('two-factor.qr-code'));
});

// مسار user/two-factor-recovery-codes
Breadcrumbs::for('two-factor.recovery-codes', function (BreadcrumbTrail $trail) {
    $trail->parent('profile.show');
    $trail->push(__('Two-Factor Recovery Codes'), route('two-factor.recovery-codes'));
});
// --> End Profile


// Language Switch
Breadcrumbs::for('lang.switch', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('Change Language'), route('lang.switch', ['locale' => app()->getLocale()]));
});

// --> Super Admin Routes
Breadcrumbs::for('super-admin.admins.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Admins'), route('super-admin.admins.index'));
});

Breadcrumbs::for('super-admin.admins.create', function (BreadcrumbTrail $trail) {
    $trail->parent('super-admin.admins.index');
    $trail->push(__('Create Admin'), route('super-admin.admins.create'));
});

Breadcrumbs::for('super-admin.admins.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('super-admin.admins.index');
    $trail->push(__('Edit Admin'), route('super-admin.admins.edit', $id));
});

// Notifications
Breadcrumbs::for('super-admin.notifications.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Notifications'), route('super-admin.notifications.index'));
});


// Departments
Breadcrumbs::for('super-admin.departments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Departments'), route('super-admin.departments.index'));
});

Breadcrumbs::for('super-admin.departments.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('super-admin.departments.index');
    $trail->push(__('Department Details'), route('super-admin.departments.show', $id));
});

Breadcrumbs::for('super-admin.departments.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('super-admin.departments.index');
    $trail->push(__('Edit Department'), route('super-admin.departments.edit', $id));
});

Breadcrumbs::for('super-admin.departments.status', function (BreadcrumbTrail $trail, $department, $status) {
    $trail->parent('super-admin.departments.index');
    $trail->push(__('Students With Status'), route('super-admin.departments.status', ['department' => $department, 'status' => $status]));
});

// Specialization Types
Breadcrumbs::for('super-admin.specializations.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Specializations'), route('super-admin.specializations.index'));
});

Breadcrumbs::for('super-admin.specializations.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('super-admin.specializations.index');
    $trail->push(__('Specialization Details'), route('super-admin.specializations.show', $id));
});

Breadcrumbs::for('super-admin.specializations.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('super-admin.specializations.index');
    $trail->push(__('Edit Specialization'), route('super-admin.specializations.edit', $id));
});



// Reports
Breadcrumbs::for('super-admin.reports.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Reports'), route('super-admin.reports.index'));
});

// Students
Breadcrumbs::for('super-admin.students.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Students'), route('super-admin.students.index'));
});

Breadcrumbs::for('super-admin.students.show', function (BreadcrumbTrail $trail, $student) {
    $trail->parent('super-admin.students.index');
    $trail->push(__('Student Details'), route('super-admin.students.show', $student));
});

// Post Graduation
Breadcrumbs::for('super-admin.post-graduation.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Post Graduation'), route('super-admin.post-graduation.index'));
});

Breadcrumbs::for('super-admin.post-graduation.show', function (BreadcrumbTrail $trail, $post_graduation) {
    $trail->parent('super-admin.post-graduation.index');
    $trail->push(__('Post Graduation Details'), route('super-admin.post-graduation.show', $post_graduation));
});


// Payments
Breadcrumbs::for('super-admin.payments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Payments'), route('super-admin.payments.index'));
});

Breadcrumbs::for('super-admin.payments.show', function (BreadcrumbTrail $trail, $postGraduation) {
    $trail->parent('super-admin.payments.index');
    $trail->push(__('Payment Details'), route('super-admin.payments.show', $postGraduation));
});

// Researches
Breadcrumbs::for('super-admin.researches.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Researches'), route('super-admin.researches.index'));
});

Breadcrumbs::for('super-admin.researches.show', function (BreadcrumbTrail $trail, $post_graduation) {
    $trail->parent('super-admin.researches.index');
    $trail->push(__('Research Details'), route('super-admin.researches.show', $post_graduation));
});

Breadcrumbs::for('super-admin.researches.status', function (BreadcrumbTrail $trail, $status) {
    $trail->parent('super-admin.researches.index');
    $trail->push(__('Researches With Status'), route('super-admin.researches.status', ['status' => $status]));
});

// Settings
Breadcrumbs::for('super-admin.settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Settings'), route('super-admin.settings.index'));
});

// --> Admin Routes
Breadcrumbs::for('admin.departments.status', function (BreadcrumbTrail $trail, $department, $status) {
    $trail->parent('panel');
    $trail->push(__('Department Status'), route('admin.departments.status', [$department, $status]));
});

// Students
Breadcrumbs::for('admin.students.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Students'), route('admin.students.index'));
});

Breadcrumbs::for('admin.students.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.students.index');
    $trail->push(__('Create Student'), route('admin.students.create'));
});

Breadcrumbs::for('admin.students.show', function (BreadcrumbTrail $trail, $student) {
    $trail->parent('admin.students.index');
    $trail->push(__('Student Details'), route('admin.students.show', $student));
});

Breadcrumbs::for('admin.students.edit', function (BreadcrumbTrail $trail, $student) {
    $trail->parent('admin.students.index');
    $trail->push(__('Edit Student'), route('admin.students.edit', $student));
});

// Post Graduation Steps
Breadcrumbs::for('admin.post-graduation.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Post Graduation Steps'), route('admin.post-graduation.index'));
});

Breadcrumbs::for('admin.post-graduation.show', function (BreadcrumbTrail $trail, $postGraduation) {
    $trail->parent('admin.post-graduation.index');
    $trail->push(__('Post Graduation Details'), route('admin.post-graduation.show', $postGraduation));
});

// Researches
Breadcrumbs::for('admin.researches.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Researches'), route('admin.researches.index'));
});

Breadcrumbs::for('admin.researches.show', function (BreadcrumbTrail $trail, $research) {
    $trail->parent('admin.researches.index');
    $trail->push(__('Research Details'), route('admin.researches.show', $research));
});

Breadcrumbs::for('admin.researches.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.researches.index');
    $trail->push(__('New Research'), route('admin.researches.create'));
});

Breadcrumbs::for('admin.researches.edit', function (BreadcrumbTrail $trail, $research) {
    $trail->parent('admin.researches.index');
    $trail->push(__('Edit Research'), route('admin.researches.edit', $research));
});

Breadcrumbs::for('admin.researches.status', function (BreadcrumbTrail $trail, $status) {
    $trail->parent('admin.researches.index');
    $trail->push(__('Researches With Status'), route('admin.researches.status', ['status' => $status]));
});

// Payments
Breadcrumbs::for('admin.payments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel');
    $trail->push(__('Payments'), route('admin.payments.index'));
});

Breadcrumbs::for('admin.payments.show', function (BreadcrumbTrail $trail, $postGraduation) {
    $trail->parent('admin.payments.index');
    $trail->push(__('Payment Details'), route('admin.payments.show', $postGraduation));
});

Breadcrumbs::for('admin.send-emails.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel', 'Emails');
    $trail->push(__('Emails'), route('admin.send-emails.index'));
});
