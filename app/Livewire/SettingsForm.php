<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsForm extends Component
{
    use WithFileUploads;

    public $site_name, $site_logo, $new_logo;
    public $favicon, $new_favicon;
    public $primary_color, $secondary_color, $accent_color, $background_color;
    public $confirmingReset = false;


    public function mount()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        if ($setting) {
            $this->site_name = $setting->site_name;
            $this->site_logo = $setting->site_logo;
            $this->favicon = $setting->favicon;
            $this->primary_color = $setting->primary_color;
            $this->secondary_color = $setting->secondary_color;
            $this->accent_color = $setting->accent_color;
            $this->background_color = $setting->background_color;
        }
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'new_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'new_favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'accent_color' => 'required|string',
            'background_color' => 'required|string',
        ]);

        $setting = Setting::first() ?? new Setting();

        // رفع الشعار
        if ($this->new_logo) {
            if ($setting->site_logo && file_exists(storage_path('app/public/' . str_replace('storage/', '', $setting->site_logo)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $setting->site_logo)));
            }

            $filename = time() . '_logo.' . $this->new_logo->getClientOriginalExtension();
            $this->new_logo->storeAs('images/logos', $filename, 'local-public');
            $setting->site_logo = 'images/logos/' . $filename;
        }

        // رفع الـ favicon
        if ($this->new_favicon) {
            if ($setting->favicon && file_exists(storage_path('app/public/' . str_replace('storage/', '', $setting->favicon)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $setting->favicon)));
            }

            $filename = time() . '_favicon.' . $this->new_favicon->getClientOriginalExtension();
            $this->new_favicon->storeAs('images/icons', $filename, 'local-public');
            $setting->favicon = 'images/icons/' . $filename;
        }

        // تحديث باقي الإعدادات
        $setting->site_name = $this->site_name;
        $setting->primary_color = $this->primary_color;
        $setting->secondary_color = $this->secondary_color;
        $setting->accent_color = $this->accent_color;
        $setting->background_color = $this->background_color;
        $setting->save();

        session()->flash('success', __("Settings updated successfully!"));
    }



    public function removeLogo()
    {
        $setting = Setting::first();
        if ($setting && $setting->site_logo && file_exists(public_path($setting->site_logo))) {
            unlink(public_path($setting->site_logo));
            $setting->site_logo = null;
            $setting->save();
        }

        $this->site_logo = null;
        session()->flash('success', __("Logo deleted successfully!"));
    }

    public function removeFavicon()
    {
        $setting = Setting::first();
        if ($setting && $setting->favicon && file_exists(public_path($setting->favicon))) {
            unlink(public_path($setting->favicon));
            $setting->favicon = null;
            $setting->save();
        }

        $this->favicon = null;
        session()->flash('success', __("Favicon deleted successfully!"));
    }

    public function resetToDefaults()
    {
        $setting = Setting::first() ?? new Setting();

        // حذف الصور القديمة إن وُجدت
        if ($setting->site_logo && file_exists(public_path($setting->site_logo))) {
            unlink(public_path($setting->site_logo));
        }

        if ($setting->favicon && file_exists(public_path($setting->favicon))) {
            unlink(public_path($setting->favicon));
        }

        // إعادة القيم الافتراضية
        $setting->site_logo = null;
        $setting->favicon = null;
        $setting->site_name = 'University System';
        $setting->primary_color = '#fbc2eb';
        $setting->secondary_color = '#a6c1ee';
        $setting->accent_color = '#0d6efd';
        $setting->background_color = '#6610f2';
        $setting->save();

        // تحديث الخصائص في الـ component
        $this->site_logo = null;
        $this->favicon = null;
        $this->site_name = $setting->site_name;
        $this->primary_color = $setting->primary_color;
        $this->secondary_color = $setting->secondary_color;
        $this->accent_color = $setting->accent_color;
        $this->background_color = $setting->background_color;

        session()->flash('success', __("Settings reset to defaults successfully!"));
    }


    public function render()
    {
        return view('livewire.settings-form');
    }
}
