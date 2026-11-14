<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Faculty profiles at {{ $siteSettings->site_name }} {{ $siteSettings->site_tagline }}.">
    <title>Faculty Profiles - {{ $siteSettings->site_name }} {{ $siteSettings->site_tagline }}</title>
    <link rel="icon" type="image/png" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="apple-touch-icon" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/scps.css') }}?v={{ filemtime(public_path('css/scps.css')) }}">
</head>
<body class="acps-public-page">
    @include('partials.site-header-modern')

    <main class="acps-public-faculty-directory">
        <section class="acps-faculty-directory-hero">
            <div class="acps-container">
                <span class="acps-faculty-section-label">Faculty directory</span>
                <div class="acps-faculty-directory-hero__row">
                    <div>
                        <h1>People who make learning meaningful.</h1>
                        <p>Meet the mentors bringing pharmaceutical sciences to life through teaching, research, and personal guidance.</p>
                    </div>
                    <div class="acps-faculty-directory-hero__count">
                        <strong>{{ count($faculty) }}</strong>
                        <span>Faculty profiles</span>
                    </div>
                </div>
                <div class="acps-faculty-directory-hero__footer">
                    <span>{{ $siteSettings->site_name }}</span>
                    <span>Discover the people behind your learning</span>
                </div>
            </div>
        </section>

        <section class="acps-faculty-directory-content">
            <div class="acps-container">
                <div class="acps-faculty-directory-content__heading">
                    <div>
                        <span class="acps-faculty-section-label">Our academic community</span>
                        <h2>Meet the faculty</h2>
                    </div>
                    <p>Explore each profile to learn about academic interests, teaching areas, and ways to connect.</p>
                </div>

                <div class="acps-faculty-directory-grid">
                    @forelse ($faculty as $member)
                        <a class="acps-faculty-directory-card" href="{{ route('faculty.show', $member->slug) }}">
                            <div class="acps-faculty-directory-card__portrait">
                                @if ($member->image_path)
                                    <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}">
                                @else
                                    <span class="acps-faculty-directory-card__placeholder">
                                        <img src="{{ $siteSettings->logoUrl() }}" alt="">
                                        <small>Faculty portrait</small>
                                    </span>
                                @endif
                                <span class="acps-faculty-directory-card__department">{{ $member->department }}</span>
                            </div>
                            <div class="acps-faculty-directory-card__content">
                                <span class="acps-faculty-directory-card__eyebrow">Faculty member</span>
                                <h3>{{ $member->name }}</h3>
                                <p class="acps-faculty-directory-card__designation">{{ preg_replace('/\s*\/\s*/', '/ ', \Illuminate\Support\Str::title(mb_strtolower($member->designation))) }}</p>
                                @if ($member->summary)
                                    <p class="acps-faculty-directory-card__summary">{{ $member->summary }}</p>
                                @endif
                                <span class="acps-faculty-directory-card__link">View profile <span aria-hidden="true">&rarr;</span></span>
                            </div>
                        </a>
                    @empty
                        <div class="acps-faculty-directory-empty">
                            <span class="acps-faculty-section-label">Faculty directory</span>
                            <h2>Faculty profiles are coming soon.</h2>
                            <p>Once profiles are added, you will be able to explore faculty departments, teaching areas, and academic interests here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    @include('partials.site-footer-modern')
</body>
</html>
