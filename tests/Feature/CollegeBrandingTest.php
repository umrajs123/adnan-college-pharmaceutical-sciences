<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollegeBrandingTest extends TestCase
{
    use RefreshDatabase;

    public function test_branch_brand_is_used_without_rewriting_shared_site_settings(): void
    {
        $storedSettings = SiteSetting::query()->create([
            'site_name' => 'Swat College',
            'site_tagline' => 'of Pharmaceutical Sciences',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Adnan College of Pharmaceutical Sciences')
            ->assertDontSee('Swat College')
            ->assertDontSee('scps.edu.pk')
            ->assertSee('acps-hero', false)
            ->assertSee('acps-footer', false);

        $this->assertSame('Swat College', $storedSettings->fresh()->site_name);
    }
}
