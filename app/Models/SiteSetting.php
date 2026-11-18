<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_description',
        'logo_path',
        'favicon_path',
        'phone',
        'email',
        'address',
        'admissions_url',
        'facebook_url',
        'linkedin_url',
        'youtube_url',
        'privacy_url',
        'admissions_popup_is_active',
        'admissions_popup_eyebrow',
        'admissions_popup_heading',
        'admissions_popup_body',
        'admissions_popup_button_label',
        'admissions_popup_button_url',
        'admissions_popup_image_path',
        'admissions_popup_session',
    ];

    protected function casts(): array
    {
        return [
            'admissions_popup_is_active' => 'boolean',
        ];
    }

    public static function current(): self
    {
        $settings = Schema::hasTable('site_settings')
            ? static::query()->first() ?? new static(static::defaults())
            : new static(static::defaults());

        $settings->setAttribute('site_name', config('college.name'));
        $settings->setAttribute('site_tagline', config('college.tagline'));
        $settings->setAttribute('site_description', config('college.description'));
        $settings->setAttribute('admissions_popup_body', config('college.admissions_popup_body'));
        $settings->setAttribute('email', config('college.email'));

        return $settings;
    }

    public static function defaults(): array
    {
        return [
            'site_name' => config('college.name'),
            'site_tagline' => config('college.tagline'),
            'site_description' => config('college.description'),
            'logo_path' => config('college.logo_path'),
            'favicon_path' => config('college.logo_path'),
            'phone' => '+92 946 123456',
            'email' => config('college.email'),
            'address' => 'College Road, Swat, Khyber Pakhtunkhwa, Pakistan',
            'admissions_url' => 'https://scps.digitalcampuspro.com/admin/login',
            'facebook_url' => null,
            'linkedin_url' => null,
            'youtube_url' => null,
            'privacy_url' => '#',
            'admissions_popup_is_active' => true,
            'admissions_popup_eyebrow' => 'Admissions Open',
            'admissions_popup_heading' => 'Your future in pharmacy starts here.',
            'admissions_popup_body' => config('college.admissions_popup_body'),
            'admissions_popup_button_label' => 'Apply Now',
            'admissions_popup_button_url' => null,
            'admissions_popup_image_path' => null,
            'admissions_popup_session' => '2026-27',
        ];
    }

    public function logoUrl(): string
    {
        $path = $this->logo_path ?: static::defaults()['logo_path'];
        $url = $this->assetUrl($path);
        $file = str_starts_with($path, 'site-settings/')
            ? storage_path('app/public/'.$path)
            : public_path($path);

        if (is_file($file)) {
            $url .= (str_contains($url, '?') ? '&' : '?').'v='.filemtime($file);
        }

        return $url;
    }

    public function faviconUrl(): string
    {
        $path = $this->favicon_path ?: $this->logo_path ?: static::defaults()['favicon_path'];
        $url = $this->assetUrl($path);
        $file = str_starts_with($path, 'site-settings/')
            ? storage_path('app/public/'.$path)
            : public_path($path);

        if (is_file($file)) {
            $url .= (str_contains($url, '?') ? '&' : '?').'v='.filemtime($file);
        }

        return $url;
    }

    public function phoneHref(): ?string
    {
        if (! $this->phone) {
            return null;
        }

        return 'tel:'.preg_replace('/[^0-9+]/', '', $this->phone);
    }

    public function emailHref(): ?string
    {
        return $this->email ? 'mailto:'.$this->email : null;
    }

    public function admissionsPopupImageUrl(): ?string
    {
        // Keep the popup artwork independent from the Nursing page's fallback image.
        if ($this->admissions_popup_image_path === 'images/nursing-care.jpg') {
            return asset('images/admissions-medicine.png');
        }

        return $this->admissions_popup_image_path
            ? $this->assetUrl($this->admissions_popup_image_path)
            : null;
    }

    private function assetUrl(?string $path): string
    {
        if (! $path) {
            return asset(config('college.logo_path'));
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        if (str_starts_with($path, 'site-settings/')) {
            return asset('storage/'.$path);
        }

        return asset($path);
    }
}
