<?php
namespace App\Http\Controllers;
use App\Models\AcademicProgram;
use App\Models\AdmissionApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class AdmissionApplicationController extends Controller {
    public function create() {
        return view('admissions.create', ['programs' => AcademicProgram::active()->orderBy('sort_order')->orderBy('title')->get()]);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[+0-9() .-]{7,30}$/'],
            'program' => ['required', 'string', Rule::exists('academic_programs', 'title')->where('is_active', true)],
            'qualification' => ['required', 'string', 'max:200'],
            'confirmation' => ['accepted'],
        ]);
        unset($data['confirmation']);
        $application = AdmissionApplication::create($data + ['reference' => (string) Str::uuid()]);
        return redirect()->route('admissions.create')->with('application_reference', $application->reference);
    }
    public function index() {
        return response()->view('admin.applications.index', ['applications' => AdmissionApplication::latest('id')->paginate(20)])
            ->header('Cache-Control', 'no-store, private');
    }
}
