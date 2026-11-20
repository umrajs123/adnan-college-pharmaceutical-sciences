<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply for Admission - {{ $siteSettings->site_name }}</title>
    <link rel="icon" href="{{ $siteSettings->faviconUrl() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/scps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admissions.css') }}?v={{ filemtime(public_path('css/admissions.css')) }}">
</head>
<body class="acps-public-page bg-white text-slate-950">
@include('partials.site-header-modern')
<main class="application-page">
    <div class="application-heading"><span>ADMISSIONS</span><h1>Start your journey</h1><p>Apply to {{ $siteSettings->site_name }}. Complete the details below and review them before submitting.</p></div>
    @if(session('application_reference'))
        <section class="application-notice" role="status"><h2>Application received</h2><p>Keep this reference for any enquiries:</p><strong>{{ session('application_reference') }}</strong><p>Your application is awaiting review. Submission does not confirm admission.</p></section>
    @else
        <form class="application-card" method="POST" action="{{ route('admissions.store') }}">
            @csrf
            <h2>Admission application</h2><p>All fields are required.</p>
            @if($errors->any())
                <div class="application-errors" role="alert"><strong>Please check your details.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <div class="application-grid">
                @foreach(['full_name' => ['Full name', 'text', 'name', 150], 'email' => ['Email address', 'email', 'email', 255], 'phone' => ['Phone number', 'tel', 'tel', 30], 'qualification' => ['Latest qualification', 'text', 'off', 200]] as $name => $field)
                    <div class="application-field"><label for="{{ $name }}">{{ $field[0] }}</label><input id="{{ $name }}" name="{{ $name }}" type="{{ $field[1] }}" autocomplete="{{ $field[2] }}" maxlength="{{ $field[3] }}" value="{{ old($name) }}" required @error($name) aria-invalid="true" aria-describedby="{{ $name }}-error" @enderror>@error($name)<small id="{{ $name }}-error">{{ $message }}</small>@enderror</div>
                @endforeach
                <div class="application-field application-wide"><label for="program">Program of interest</label><select id="program" name="program" required><option value="">Select a program</option>@foreach($programs as $program)<option value="{{ $program->title }}" @selected(old('program') === $program->title)>{{ $program->title }}</option>@endforeach</select></div>
            </div>
            @if($programs->isEmpty())<p class="application-errors">No programs are available for online applications yet. Please contact the college.</p>@endif
            <label class="application-confirm"><input type="checkbox" name="confirmation" value="1" required @checked(old('confirmation'))><span>I have reviewed my details and confirm they are accurate. The college may contact me about this application.</span></label>
            <button type="submit" @disabled($programs->isEmpty())>Submit application</button>
            <p class="application-note">Your details will be available to authorised college staff for admission review.</p>
        </form>
    @endif
</main>
@include('partials.site-footer-modern')
</body>
</html>
