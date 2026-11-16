@extends('admin.layouts.app')
@section('title', $isCreate ? 'Add Accreditation' : 'Edit Accreditation')
@section('eyebrow','Homepage Content')
@section('page_title', $isCreate ? 'Add Accreditation' : 'Edit Accreditation')
@section('content')
<form class="admin-form-shell" method="POST" enctype="multipart/form-data" action="{{ $isCreate ? route('admin.accreditation.store') : route('admin.accreditation.item.update',$item) }}">@csrf @unless($isCreate) @method('PUT') @endunless
<section class="admin-form-card"><div class="admin-card-head"><div><span class="admin-kicker">Recognition Card</span><h2>{{ $isCreate ? 'New organization' : 'Update organization' }}</h2><p>This card appears in the homepage Accreditation &amp; Recognition section.</p></div></div><div class="admin-form-grid">
<label>Organization name<input name="name" value="{{ old('name',$item->name) }}" required></label><label>Display order<input type="number" name="sort_order" value="{{ old('sort_order',$item->sort_order) }}" min="0" required></label>
<label class="span-2">Description<textarea name="description" rows="5" required>{{ old('description',$item->description) }}</textarea></label>
<label class="span-2">Official logo path or URL<input name="logo_path" value="{{ old('logo_path',$item->logo_path) }}" placeholder="images/logo-example.png"></label>
<label class="span-2">Badge icon upload<input type="file" name="icon" accept="image/png,image/jpeg,image/webp"><small class="field-hint">Optional. Leave empty to use the built-in shield.</small></label>
<label class="admin-check span-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$item->is_active))><span>Show this card on the homepage</span></label>
</div></section><aside class="admin-preview-card"><span class="admin-kicker">Live Card</span><h3>{{ old('name',$item->name) ?: 'Organization name' }}</h3><p>{{ old('description',$item->description) ?: 'Recognition details.' }}</p><div class="admin-form-actions"><a href="{{ route('admin.accreditation.index') }}">Cancel</a><button type="submit">{{ $isCreate ? 'Add Accreditation' : 'Save Changes' }}</button></div></aside></form>
@endsection
