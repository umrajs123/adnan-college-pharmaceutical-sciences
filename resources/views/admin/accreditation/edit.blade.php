@extends('admin.layouts.app')

@section('title', 'Accreditation & Recognition')
@section('eyebrow', 'Homepage Content')
@section('page_title', 'Accreditation & Recognition')

@section('content')
    <form class="admin-form-shell" method="POST" enctype="multipart/form-data" action="{{ route('admin.accreditation.update') }}">
        @csrf
        @method('PUT')
        <section class="admin-form-card">
            <div class="admin-card-head"><div><span class="admin-kicker">Institutional Trust</span><h2>Homepage recognition section</h2><p>Keep recognition, affiliation, and registration information clear and easy for prospective students to verify.</p></div></div>
            <div class="admin-form-grid">
                <label>Eyebrow<input name="eyebrow" value="{{ old('eyebrow', $section->eyebrow) }}">@error('eyebrow')<small class="field-error">{{ $message }}</small>@enderror</label>
                <div class="admin-form-note span-2"><strong>Organization icons</strong><p>Upload an optional PNG, JPG, or WebP icon for each card. Empty fields use the built-in verification shield.</p></div>
                @foreach(['PNMC card', 'KMU card', 'HERA card'] as $index => $label)
                    <label>{{ $label }} icon
                        <input type="file" name="icon_files[]" accept="image/png,image/jpeg,image/webp">
                        @if(!empty($section->icon_paths[$index]))<small class="field-hint">Custom icon uploaded. Choose another file to replace it.</small>@endif
                        @error('icon_files.'.$index)<small class="field-error">{{ $message }}</small>@enderror
                    </label>
                @endforeach
                <label class="span-2">Heading<input name="title" value="{{ old('title', $section->title) }}" required>@error('title')<small class="field-error">{{ $message }}</small>@enderror</label>
                <label class="span-2">Recognition entries<textarea name="body" rows="9" required>{{ old('body', $section->body) }}</textarea><small class="field-hint">One entry per line in this format: Authority name::Short explanation.</small>@error('body')<small class="field-error">{{ $message }}</small>@enderror</label>
                <label class="admin-check span-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active))><span>Show this section on the homepage</span></label>
            </div>
        </section>
        <aside class="admin-preview-card campus-event-accent campus-event-accent--teal"><span class="admin-kicker">Homepage Section</span><h3>{{ old('title', $section->title) }}</h3><p>Recognition details will appear below the homepage introduction and before the academic content.</p><div class="admin-form-actions"><a href="{{ route('admin.dashboard') }}">Cancel</a><button type="submit">Save Accreditation</button></div></aside>
    </form>
@endsection
