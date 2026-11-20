<?php
namespace Tests\Feature;
use App\Models\AcademicProgram;
use App\Models\AdmissionApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AdmissionApplicationTest extends TestCase {
    use RefreshDatabase;
    public function test_application_is_saved_and_staff_can_review_it(): void {
        AcademicProgram::create(['title' => 'Pharm D', 'slug' => 'pharm-d', 'is_active' => true]);
        $this->get('/apply')->assertOk()->assertSee('Pharm D');
        $this->post('/apply', ['full_name' => 'Test Applicant', 'email' => 'applicant@example.com', 'phone' => '03001234567', 'program' => 'Pharm D', 'qualification' => 'FSc', 'confirmation' => '1'])
            ->assertRedirect('/apply')->assertSessionHas('application_reference');
        $this->assertDatabaseHas('admission_applications', ['email' => 'applicant@example.com']);
        $this->get('/apply')->assertSee(AdmissionApplication::first()->reference)->assertSee('Application received');
        $this->get('/admin/applications')->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create())->get('/admin/applications')->assertOk()->assertSee('Test Applicant');
    }
    public function test_invalid_submission_is_not_saved(): void {
        AcademicProgram::create(['title' => 'Hidden', 'slug' => 'hidden', 'is_active' => false]);
        $this->post('/apply', ['full_name' => 'Test', 'email' => 'invalid', 'phone' => 'abc', 'program' => 'Hidden', 'qualification' => 'FSc'])
            ->assertSessionHasErrors(['email', 'phone', 'program', 'confirmation']);
        $this->assertDatabaseCount('admission_applications', 0);
    }
    public function test_no_programs_disables_submission(): void {
        $this->get('/apply')->assertOk()->assertSee('No programs are available')->assertSee('disabled');
    }
}
