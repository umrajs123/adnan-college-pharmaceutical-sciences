<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SiteLogoSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploaded_logo_is_saved_and_used_on_frontend_and_admin_pages(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $settings = SiteSetting::query()->create(SiteSetting::defaults());

        $response = $this->actingAs($user)->put(route('admin.settings.update'), [
            'site_name' => $settings->site_name,
            'site_tagline' => $settings->site_tagline,
            'site_description' => $settings->site_description,
            'logo_path' => $settings->logo_path,
            'favicon_path' => $settings->favicon_path,
            'logo' => UploadedFile::fake()->image('new-college-logo.png', 320, 320),
            'phone' => $settings->phone,
            'email' => $settings->email,
            'address' => $settings->address,
            'admissions_url' => $settings->admissions_url,
            'privacy_url' => $settings->privacy_url,
        ]);

        $response->assertSessionHasNoErrors()->assertRedirect(route('admin.settings.edit'));

        $savedLogo = SiteSetting::query()->firstOrFail()->logo_path;
        $this->assertStringStartsWith('site-settings/', $savedLogo);
        $this->assertSame($savedLogo, SiteSetting::query()->firstOrFail()->favicon_path);
        Storage::disk('public')->assertExists($savedLogo);

        $logoUrl = asset('storage/'.$savedLogo);
        $this->get('/')->assertOk()->assertSee($logoUrl, false);
        $this->actingAs($user)->get('/admin')->assertOk()->assertSee($logoUrl, false);
        $this->post(route('admin.logout'));
        $this->get('/admin/login')->assertOk()->assertSee($logoUrl, false);
    }

    public function test_svg_logo_upload_is_accepted(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $settings = SiteSetting::query()->create(SiteSetting::defaults());
        $svg = UploadedFile::fake()->createWithContent(
            'college-logo.svg',
            '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"><circle cx="60" cy="60" r="50" fill="#173d31"/></svg>'
        );

        $this->actingAs($user)->put(route('admin.settings.update'), [
            'site_name' => $settings->site_name,
            'site_tagline' => $settings->site_tagline,
            'site_description' => $settings->site_description,
            'logo_path' => $settings->logo_path,
            'favicon_path' => $settings->favicon_path,
            'logo' => $svg,
            'phone' => $settings->phone,
            'email' => $settings->email,
            'address' => $settings->address,
            'admissions_url' => $settings->admissions_url,
            'privacy_url' => $settings->privacy_url,
        ])->assertSessionHasNoErrors();

        $savedLogo = SiteSetting::query()->firstOrFail()->logo_path;
        Storage::disk('public')->assertExists($savedLogo);
        $this->assertStringEndsWith('.svg', $savedLogo);
    }

    public function test_admissions_url_can_be_cleared(): void
    {
        $user = User::factory()->create();
        $settings = SiteSetting::query()->create(array_merge(SiteSetting::defaults(), [
            'admissions_url' => 'https://example.edu/admissions',
        ]));

        $this->actingAs($user)->put(route('admin.settings.update'), [
            'site_name' => $settings->site_name,
            'site_tagline' => $settings->site_tagline,
            'site_description' => $settings->site_description,
            'logo_path' => $settings->logo_path,
            'favicon_path' => $settings->favicon_path,
            'admissions_url' => '   ',
            'phone' => $settings->phone,
            'email' => $settings->email,
            'address' => $settings->address,
            'privacy_url' => $settings->privacy_url,
        ])->assertSessionHasNoErrors();

        $this->assertNull(SiteSetting::query()->firstOrFail()->admissions_url);
    }
}
