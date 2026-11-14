<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $member->name }} faculty profile at {{ $siteSettings->site_name }} {{ $siteSettings->site_tagline }}.">
    <title>{{ $member->name }} - Faculty Profile</title>
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

    <main class="acps-public-faculty-profile">
        <section class="acps-faculty-profile-hero">
            <div class="acps-container">
                <a class="acps-faculty-profile__back" href="{{ route('faculty.index') }}">
                    <span aria-hidden="true">&larr;</span> Faculty directory
                </a>
                <div class="acps-faculty-profile__hero-grid">
                    <div class="acps-faculty-profile__intro">
                        <span class="acps-faculty-profile__eyebrow">{{ $member->department }}</span>
                        <h1>{{ $member->name }}</h1>
                        <p class="acps-faculty-profile__designation">{{ $member->designation }}</p>
                        @if ($member->summary)
                            <p class="acps-faculty-profile__summary">{{ $member->summary }}</p>
                        @endif
                        <div class="acps-faculty-profile__actions">
                            @if ($member->email)
                                <a class="acps-faculty-profile__primary-action" href="mailto:{{ $member->email }}">Email faculty <span aria-hidden="true">&rarr;</span></a>
                            @endif
                            <a class="acps-faculty-profile__secondary-action" href="{{ route('faculty.index') }}">Meet the faculty</a>
                        </div>
                    </div>

                    <div class="acps-faculty-profile__portrait-wrap">
                        @if ($member->image_path)
                            <img class="acps-faculty-profile__portrait" src="{{ $member->imageUrl() }}" alt="{{ $member->name }}">
                        @else
                            <div class="acps-faculty-profile__portrait-placeholder">
                                <img src="{{ $siteSettings->logoUrl() }}" alt="{{ $siteSettings->site_name }} logo">
                                <span>Faculty portrait</span>
                            </div>
                        @endif
                        <div class="acps-faculty-profile__department-card">
                            <span>Department</span>
                            <strong>{{ $member->department }}</strong>
                        </div>
                        <span class="acps-faculty-profile__portrait-caption">Faculty &amp; academic mentors</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="acps-faculty-profile-content">
            <div class="acps-container acps-faculty-profile__content-grid">
                <article class="acps-faculty-profile__biography">
                    <span class="acps-faculty-section-label">Faculty profile</span>
                    <h2>Academic biography</h2>
                    @if ($member->bio)
                        <p class="acps-faculty-profile__bio-copy">{{ $member->bio }}</p>
                    @else
                        <p class="acps-faculty-profile__bio-copy">This faculty member supports students through teaching, academic guidance, and a commitment to learning in pharmaceutical sciences.</p>
                    @endif

                    <div class="acps-faculty-profile__credentials">
                        @if ($member->education)
                            <div>
                                <span>Education</span>
                                <strong>{{ $member->education }}</strong>
                            </div>
                        @endif
                        @if ($member->experience)
                            <div>
                                <span>Experience</span>
                                <strong>{{ $member->experience }}</strong>
                            </div>
                        @endif
                    </div>
                </article>

                <aside class="acps-faculty-profile__sidebar">
                    <section class="acps-faculty-profile__info-card">
                        <span class="acps-faculty-section-label">Connect</span>
                        <h2>Contact details</h2>
                        @if ($member->email || $member->office)
                            <dl>
                                @if ($member->email)
                                    <div>
                                        <dt>Email</dt>
                                        <dd><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></dd>
                                    </div>
                                @endif
                                @if ($member->office)
                                    <div>
                                        <dt>Office</dt>
                                        <dd>{{ $member->office }}</dd>
                                    </div>
                                @endif
                            </dl>
                        @else
                            <p>Contact details are not currently listed. Please reach out through the college faculty directory.</p>
                        @endif
                    </section>

                    <section class="acps-faculty-profile__info-card acps-faculty-profile__teaching">
                        <span class="acps-faculty-section-label">Learning</span>
                        <h2>Teaching areas</h2>
                        @forelse ($member->courses ?? [] as $course)
                            <span class="acps-faculty-profile__topic">{{ $course }}</span>
                        @empty
                            <p>Teaching areas will be added to this profile soon.</p>
                        @endforelse
                    </section>
                </aside>
            </div>
        </section>

        @if (count($member->specialties ?? []) > 0)
            <section class="acps-faculty-profile-focus">
                <div class="acps-container">
                    <div class="acps-faculty-profile__section-heading">
                        <div>
                            <span class="acps-faculty-section-label">Academic interests</span>
                            <h2>Areas of expertise</h2>
                        </div>
                        <a href="{{ route('faculty.index') }}">Browse all faculty <span aria-hidden="true">&rarr;</span></a>
                    </div>
                    <div class="acps-faculty-profile__focus-grid">
                        @foreach ($member->specialties as $specialty)
                            <article>
                                <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $specialty }}</h3>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="acps-faculty-profile-others">
            <div class="acps-container">
                <div class="acps-faculty-profile__section-heading">
                    <div>
                        <span class="acps-faculty-section-label">Our community</span>
                        <h2>Meet more of our faculty</h2>
                    </div>
                    <a href="{{ route('faculty.index') }}">View directory <span aria-hidden="true">&rarr;</span></a>
                </div>
                <div class="acps-faculty-profile__colleagues">
                    @forelse ($faculty as $other)
                        @continue($other->id === $member->id)
                        <a href="{{ route('faculty.show', $other->slug) }}">
                            @if ($other->image_path)
                                <img src="{{ $other->imageUrl() }}" alt="">
                            @else
                                <span class="acps-faculty-profile__colleague-mark"><img src="{{ $siteSettings->logoUrl() }}" alt=""></span>
                            @endif
                            <span class="acps-faculty-profile__colleague-copy">
                                <strong>{{ $other->name }}</strong>
                                <small>{{ $other->department }}</small>
                            </span>
                            <span class="acps-faculty-profile__colleague-arrow" aria-hidden="true">&rarr;</span>
                        </a>
                    @empty
                        <p class="acps-faculty-profile__empty">More faculty profiles will be featured here soon.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    @include('partials.site-footer-modern')
</body>
</html>
