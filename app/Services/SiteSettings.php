<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSettings
{
    public const CACHE_KEY = 'site_settings';

    /**
     * @return array<string, mixed>
     */
    public function defaults(): array
    {
        return [
            'general.company_name' => 'Horizonion Microcare Association',
            'general.tagline' => 'Trust, Growth, Community',
            'general.short_description' => 'A women-focused financial inclusion initiative that helps communities access responsible loan information and support. Details on this website are placeholders until the organization publishes official content.',
            'branding.logo_rectangle' => 'images/logo-rectangle.png',
            'branding.logo_square' => 'images/logo-square.png',
            'branding.favicon' => null,
            'contact.phone' => '+91 20 4000 1200',
            'contact.email' => 'hello@horizonmicrocare.test',
            'contact.whatsapp' => '+91 98765 00000',
            'contact.address' => '3rd Floor, Community Hub, Kothrud, Pune, Maharashtra 411038',
            'contact.office_hours' => 'Monday to Friday, 10:00 AM – 5:30 PM',
            'contact.map_embed' => '',
            'social.facebook' => '',
            'social.instagram' => '',
            'social.linkedin' => '',
            'social.twitter' => '',
            'social.youtube' => '',
            'footer.copyright' => '© '.now()->year.' Horizonion Microcare Association. All rights reserved.',
            'footer.legal_text' => 'Information on this website is provided for general awareness. Submitting an enquiry or application does not guarantee loan approval.',
            'seo.default_title' => 'Horizonion Microcare Association',
            'seo.default_description' => 'Women-focused financial inclusion, livelihood support, and responsible lending information.',
            'seo.default_og_image' => 'images/logo-rectangle.png',
            'consent.text' => 'I consent to the organization contacting me regarding my application and understand that submission of this form does not guarantee loan approval.',
            'consent.version' => '1.0',
        ];
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = data_get($this->all(), $key);

        if ($value === null || $value === '') {
            return $default ?? ($this->defaults()[$key] ?? null);
        }

        return $value;
    }

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        $defaults = [];

        foreach ($this->defaults() as $key => $value) {
            data_set($defaults, $key, $value);
        }

        try {
            if (! Schema::hasTable('site_settings')) {
                return $defaults;
            }

            $stored = Cache::rememberForever(self::CACHE_KEY, function (): array {
                $values = [];

                SiteSetting::query()
                    ->orderBy('id')
                    ->get()
                    ->each(function (SiteSetting $setting) use (&$values): void {
                        data_set($values, $setting->group.'.'.$setting->key, $setting->value);
                    });

                return $values;
            });
        } catch (\Throwable) {
            return $defaults;
        }

        return array_replace_recursive($defaults, $stored);
    }

    /**
     * @return array<string, mixed>
     */
    public function flat(): array
    {
        $flat = $this->defaults();

        foreach ($this->defaults() as $key => $default) {
            $flat[$key] = data_get($this->all(), $key, $default);
        }

        return $flat;
    }

    public function set(string $key, mixed $value, string $type = 'text'): void
    {
        [$group, $settingKey] = $this->splitKey($key);

        SiteSetting::query()->updateOrCreate(
            ['group' => $group, 'key' => $settingKey],
            ['value' => $value, 'type' => $type],
        );

        $this->forgetCache();
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            $type = $this->guessType($key, $value);
            $this->set($key, $value, $type);
        }
    }

    public function logoUrl(string $variant = 'rectangle'): string
    {
        $path = $variant === 'square'
            ? $this->get('branding.logo_square')
            : $this->get('branding.logo_rectangle');

        if (! is_string($path) || $path === '') {
            return asset('storage/images/logo-rectangle.png');
        }

        return str_starts_with($path, 'http') ? $path : asset('storage/'.$path);
    }

    public function forgetCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function splitKey(string $key): array
    {
        $segments = explode('.', $key, 2);

        return [$segments[0], $segments[1] ?? $segments[0]];
    }

    private function guessType(string $key, mixed $value): string
    {
        if (str_contains($key, 'logo') || str_contains($key, 'favicon') || str_contains($key, 'image')) {
            return 'file';
        }

        if (is_bool($value)) {
            return 'boolean';
        }

        if (is_array($value)) {
            return 'json';
        }

        return 'text';
    }
}
