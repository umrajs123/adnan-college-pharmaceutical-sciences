@extends('admin.layouts.app')
@section('title','Accreditation & Recognition')
@section('eyebrow','Homepage Content')
@section('page_title','Accreditation & Recognition')
@section('content')
<section class="admin-form-card accreditation-admin-shell">
 <div class="admin-card-head"><div><span class="admin-kicker">Homepage Trust</span><h2>Recognition cards</h2><p>Add, update, show, or hide each organization independently.</p></div><div class="accreditation-admin-actions"><a class="accreditation-admin-settings" href="{{ route('admin.accreditation.edit') }}">Section Settings</a><a class="admin-create-link" href="{{ route('admin.accreditation.create') }}">+ Add Accreditation</a></div></div>
 <div class="accreditation-admin-list">
 @forelse($items as $item)
 <article><div class="accreditation-admin-list__logo">@if($item->logoUrl())<img src="{{ $item->logoUrl() }}" alt="">@endif</div><div class="accreditation-admin-list__content"><span class="admin-kicker">{{ $item->is_active ? 'Visible on homepage' : 'Hidden' }}</span><h3>{{ $item->name }}</h3><p>{{ $item->description }}</p></div><div class="admin-row-actions"><a href="{{ route('admin.accreditation.item.edit',$item) }}">Edit</a><form method="POST" action="{{ route('admin.accreditation.item.destroy',$item) }}">@csrf @method('DELETE')<button type="submit">Delete</button></form></div></article>
 @empty<div class="admin-empty-state"><h3>No accreditation cards yet.</h3><a class="admin-create-link" href="{{ route('admin.accreditation.create') }}">Add the first one</a></div>@endforelse
 </div>
</section>
@endsection
