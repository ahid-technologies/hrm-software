<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandingSettings extends Component
{
    use WithFileUploads;

    public $app_name;
    public $logo;
    public $favicon;
    public $current_logo;
    public $current_favicon;

    public function mount()
    {
        $this->app_name = config('app.name');
        $this->current_logo = $this->getCurrentLogo();
        $this->current_favicon = $this->getCurrentFavicon();
    }

    public function rules()
    {
        return [
            'app_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,svg',
            'favicon' => 'nullable|image|max:1024|mimes:png,ico,jpg,jpeg'
        ];
    }

    public function save()
    {
        $this->validate();

        // Update app name in .env file
        $this->updateEnvFile('APP_NAME', '"' . $this->app_name . '"');

        // Handle logo upload
        if ($this->logo) {
            $logoPath = $this->logo->store('branding', 'public');
            $this->updateEnvFile('APP_LOGO', $logoPath);
        }

        // Handle favicon upload
        if ($this->favicon) {
            $faviconPath = $this->favicon->store('branding', 'public');
            $this->updateEnvFile('APP_FAVICON', $faviconPath);
        }

        // Clear config cache
        Artisan::call('config:clear');

        $this->dispatch('success', message: 'Branding settings updated successfully!');

        // Refresh current values
        $this->mount();
        $this->reset(['logo', 'favicon']);
    }

    protected function updateEnvFile($key, $value)
    {
        $envFile = base_path('.env');
        $content = File::get($envFile);

        if (str_contains($content, $key)) {
            $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
        } else {
            $content .= "\n{$key}={$value}";
        }

        File::put($envFile, $content);
    }

    protected function getCurrentLogo()
    {
        return app_logo();
    }

    protected function getCurrentFavicon()
    {
        return app_favicon();
    }

    public function render()
    {
        return view('settings.branding-settings');
    }
}
