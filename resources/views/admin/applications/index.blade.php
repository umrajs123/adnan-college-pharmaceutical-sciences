@extends('admin.layouts.app')
@section('title', 'Admission Applications')
@section('eyebrow', 'Admissions')
@section('page_title', 'Applications')
@section('content')
<section class="admin-table-card">
    <div class="admin-card-head"><div><h2>Admission applications</h2><p>{{ $applications->total() }} received. Newest applications appear first.</p></div><a class="admin-create-link" href="{{ route('admissions.create') }}">View admission form</a></div>
    @forelse($applications as $application)
        <article style="padding:24px;border-top:1px solid #cbd5e1;overflow-wrap:anywhere">
            <h3>{{ $application->full_name }}</h3><p><strong>{{ $application->program }}</strong></p>
            <p>Email: {{ $application->email }}<br>Phone: {{ $application->phone }}<br>Latest qualification: {{ $application->qualification }}</p>
            <p>Reference: {{ $application->reference }}<br>Received: {{ $application->created_at->format('d M Y, H:i') }}</p>
        </article>
    @empty
        <div class="admin-empty-state"><h3>No applications yet</h3><p>Submitted admission forms will appear here.</p></div>
    @endforelse
    <div style="padding:24px">{{ $applications->links() }}</div>
</section>
@endsection
