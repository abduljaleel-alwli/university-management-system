<?php

// app/Helpers.php

use App\Models\Setting;

if (!function_exists('isActive')) {
    function isActive($routeName, $class = 'bg-white shadow-soft-xl rounded-lg')
    {
        return request()->routeIs($routeName) ? $class : '';
    }
}

if (!function_exists('isActiveIcon')) {
    function isActiveIcon($routeName, $class2 = null, $class = 'icon-active bg-gradient-to-tl from-purple-700 icon-active to-pink-500')
    {
        if (!request()->routeIs($routeName)) {
            return '';
        }

        // إذا تم تمرير class2، نضيفها إلى النتيجة
        if ($class2) {
            return trim("$class $class2");
        }

        // إذا لم يتم تمرير class2، نرجع class فقط
        return $class;
    }
}

if (!function_exists('isRtl')) {
    function isRtl()
    {
        if (app()->getLocale() == 'ar') {
            return true;
        }

        return false;
    }
}

if (!function_exists('app_settings')) {
    function app_settings()
    {
        $settings = Setting::first();

        if (!$settings) {
            $settings = Setting::create([]);
        }

        return $settings;
    }
}
