<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ \App\Support\CollegeBrand::copy($hero?->body ?: 'Explore nursing education at Adnan College.') }}">
    @php($siteSettings = \App\Models\SiteSetting::current())
    <title>{{ \App\Support\CollegeBrand::copy($hero?->title ?: 'Nursing') }} - {{ $siteSettings->site_name }}</title>
    <link rel="icon" type="image/png" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="apple-touch-icon" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/scps.css') }}?v={{ filemtime(public_path('css/scps.css')) }}">
</head>
<body class="acps-public-page bg-white text-slate-950">
    @include('partials.site-header-modern')

    <main class="nursing-page acps-nursing-page">
        <section class="acps-nursing-hero">
            <div class="acps-nursing-shell">
                <nav class="acps-nursing-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <span aria-hidden="true">/</span>
                    <span>Nursing</span>
                </nav>
                <div class="acps-nursing-hero__grid">
                    <div class="acps-nursing-hero__copy">
                        <span class="acps-nursing-kicker">
                            <span aria-hidden="true">+</span>
                            {{ \App\Support\CollegeBrand::copy($hero?->eyebrow ?: 'School of Nursing') }}
                        </span>
                        <h1>{{ \App\Support\CollegeBrand::copy($hero?->title ?: 'Nursing at Adnan College') }} <span class="nursing-hero__stethoscope" aria-hidden="true"><svg viewBox="0 0 48 56" fill="none"><path d="M12 8v10a9 9 0 0 0 18 0V8m-21 0h6m12 0h6M21 27v3a8 8 0 0 0 8 8h4" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 8v5m18-5v5" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><circle cx="38" cy="38" r="5" fill="currentColor"/><circle cx="38" cy="38" r="2" fill="#102e25"/><path d="M38 43v2a6 6 0 0 1-6 6h-3" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span></h1>
                        <p>{{ \App\Support\CollegeBrand::copy($hero?->body ?: 'Explore a nursing education built around knowledge, practical preparation, and compassionate care.') }}</p>
                        <div class="acps-nursing-actions">
                            <a class="acps-nursing-button acps-nursing-button--primary" href="{{ $hero?->button_url ?: $siteSettings->admissions_url ?: url('/#contact') }}">{{ \App\Support\CollegeBrand::copy($hero?->button_label ?: 'Explore Admissions') }} <span aria-hidden="true">&rarr;</span></a>
                            <a class="acps-nursing-button acps-nursing-button--quiet" href="{{ $hero?->secondary_button_url ?: '#nursing-college' }}">{{ \App\Support\CollegeBrand::copy($hero?->secondary_button_label ?: 'Discover Our College') }}</a>
                        </div>
                        <div class="acps-nursing-hero__assurance">
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M12 3.5 19 6v5.3c0 4.2-2.8 7.6-7 9.2-4.2-1.6-7-5-7-9.2V6l7-2.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m8.5 12.2 2.2 2.2 4.8-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span><strong>Knowledge. Skill. Compassion.</strong><small>Care that keeps people at the centre.</small></span>
                        </div>
                    </div>
                    <div class="acps-nursing-hero__visual">
                        <img src="{{ $hero?->imageUrl(asset('images/nursing-care.jpg')) }}" alt="Nursing professional ready to provide compassionate care" fetchpriority="high">
                        <div class="acps-nursing-hero__image-caption">
                            <span class="acps-nursing-hero__pulse" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M3 12h4l2.2-6 4.1 12 2.2-6H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span><strong>Learn to care</strong><small>Lead with knowledge. Serve with heart.</small></span>
                        </div>
                        <span class="acps-nursing-hero__visual-mark" aria-hidden="true">+</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="acps-nursing-content" id="nursing-college">
            <div class="acps-nursing-shell">
                @php($collegeInfo = $sections->where('section_type', 'content'))
                @if($collegeInfo->isNotEmpty())
                    <div class="acps-nursing-overview">
                        <div class="acps-nursing-overview__heading">
                            <span class="acps-nursing-section-kicker">{{ \App\Support\CollegeBrand::copy($collegeInfo->first()->eyebrow ?: 'About our college') }}</span>
                            <h2>{{ \App\Support\CollegeBrand::copy($collegeInfo->first()->title) }}</h2>
                            <span class="acps-nursing-heading-rule" aria-hidden="true"></span>
                        </div>
                        <div class="acps-nursing-overview__copy">
                            @foreach(preg_split("/\r\n|\n|\r/", trim($collegeInfo->first()->body)) as $paragraph)
                                @if(trim($paragraph) !== '')
                                    <p>{{ \App\Support\CollegeBrand::copy(trim($paragraph)) }}</p>
                                @endif
                            @endforeach
                        </div>
                        <figure class="acps-nursing-overview__image">
                            <img src="{{ $collegeInfo->first()->imageUrl(asset('images/nursing-college.jpg')) }}" alt="{{ \App\Support\CollegeBrand::copy($collegeInfo->first()->title) }} at Adnan College" loading="lazy">
                            <figcaption><span aria-hidden="true">+</span> A foundation for thoughtful care</figcaption>
                        </figure>
                    </div>
                    @if($collegeInfo->count() > 1)
                        <div class="acps-nursing-story-grid">
                            @foreach($collegeInfo->skip(1) as $section)
                                <article class="acps-nursing-story-card">
                                    <span class="acps-nursing-story-card__icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 3.5 19 6v5.3c0 4.2-2.8 7.6-7 9.2-4.2-1.6-7-5-7-9.2V6l7-2.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M12 8v8m-4-4h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                                    </span>
                                    @if($section->eyebrow)
                                        <span class="acps-nursing-section-kicker">{{ \App\Support\CollegeBrand::copy($section->eyebrow) }}</span>
                                    @endif
                                    <h3>{{ \App\Support\CollegeBrand::copy($section->title) }}</h3>
                                    @foreach(preg_split("/\r\n|\n|\r/", trim($section->body)) as $paragraph)
                                        @if(trim($paragraph) !== '')
                                            <p>{{ \App\Support\CollegeBrand::copy(trim($paragraph)) }}</p>
                                        @endif
                                    @endforeach
                                </article>
                            @endforeach
                        </div>
                    @endif
                @endif

                @php($features = $sections->where('section_type', 'feature'))
                @if($features->isNotEmpty())
                    <aside class="acps-nursing-principle" aria-label="A principle of thoughtful nursing care">
                        <div class="acps-nursing-principle__copy">
                            <span class="acps-nursing-section-kicker">A principle of thoughtful care</span>
                            <h2>See the person, not only the condition.</h2>
                            <p>Good care begins with understanding each person’s needs, listening to their concerns, and treating them with dignity.</p>
                        </div>
                        <ol class="acps-nursing-principle__steps">
                            <li><span>01</span><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h3l2-4 3.5 8 2-4H20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg> Listen closely</li>
                            <li><span>02</span><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3.5 19 6v5.3c0 4.2-2.8 7.6-7 9.2-4.2-1.6-7-5-7-9.2V6l7-2.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m8.5 12.2 2.2 2.2 4.8-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg> Respond thoughtfully</li>
                            <li><span>03</span><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20.2 8.6c0 5-8.2 10.1-8.2 10.1S3.8 13.6 3.8 8.6a4.5 4.5 0 0 1 8.2-2.5 4.5 4.5 0 0 1 8.2 2.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg> Care with dignity</li>
                        </ol>
                    </aside>

                    <div class="acps-nursing-features-head">
                        <div>
                            <span class="acps-nursing-section-kicker">Your nursing journey</span>
                            <h2>Learn with purpose. Care with confidence.</h2>
                        </div>
                        <p>Explore the values and experiences that shape a thoughtful nursing education.</p>
                    </div>
                    <div class="acps-nursing-feature-grid">
                        @foreach($features as $feature)
                            <article class="nursing-feature-card acps-nursing-card">
                                <span class="nursing-feature-icon acps-nursing-card__icon {{ $feature->icon_label === 'pulse' ? 'nursing-feature-icon--red' : '' }}" data-icon="{{ $feature->icon_label }}" aria-hidden="true">
                                    @switch($feature->icon_label)
                                        @case('heart')
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M20.8 8.8c0 5.1-8.8 10-8.8 10S3.2 13.9 3.2 8.8A4.7 4.7 0 0 1 12 6.3a4.7 4.7 0 0 1 8.8 2.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.5 11h4l1.5-2.5 2.2 5 1.5-2.5h5.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @break
                                        @case('stethoscope')
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M6 4v5a4 4 0 0 0 8 0V4M4 4h4M12 4h4m-6 9v1a4 4 0 0 0 8 0v-1m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm-4 4v1a4 4 0 0 0 8 0v-1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @break
                                        @case('shield')
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M12 3 19 6v5c0 4.6-3 8-7 10-4-2-7-5.4-7-10V6l7-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m8.5 12 2.2 2.2 4.8-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @break
                                        @case('people')
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 4 18.5V20m6-8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm6-6.7a3.5 3.5 0 0 1 0 6.8m2 3.1a3.5 3.5 0 0 1 2 3.2V20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @break
                                        @case('spark')
                                            <svg viewBox="0 0 24 24" fill="none"><path d="m12 3 1.7 5.3L19 10l-5.3 1.7L12 17l-1.7-5.3L5 10l5.3-1.7L12 3Zm6 12 .9 2.1L21 18l-2.1.9L18 21l-.9-2.1L15 18l2.1-.9L18 15ZM5 15l.8 1.7L7.5 17.5l-1.7.8L5 20l-.8-1.7-1.7-.8 1.7-.8L5 15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @break
                                        @case('pulse')
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M3 12h4l2.2-6 4.2 12 2.2-6H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @break
                                        @default
                                            {{ $feature->icon_label ?: '✚' }}
                                    @endswitch
                                </span>
                                @if($feature->image_url)
                                    <img class="nursing-feature-image acps-nursing-card__image" src="{{ $feature->imageUrl() }}" alt="{{ \App\Support\CollegeBrand::copy($feature->title) }}" loading="lazy">
                                @endif
                                <span class="nursing-feature-eyebrow acps-nursing-card__eyebrow">{{ \App\Support\CollegeBrand::copy($feature->eyebrow) }}</span>
                                <h3>{{ \App\Support\CollegeBrand::copy($feature->title) }}</h3>
                                <p>{{ \App\Support\CollegeBrand::copy($feature->body) }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif

                @php($callToAction = $sections->firstWhere('section_type', 'cta'))
                @if($callToAction)
                    <div class="nursing-cta acps-nursing-cta">
                        <div>
                            <span class="acps-nursing-section-kicker">{{ \App\Support\CollegeBrand::copy($callToAction->eyebrow ?: 'Begin your journey') }}</span>
                            <h2>{{ \App\Support\CollegeBrand::copy($callToAction->title) }}</h2>
                            <p>{{ \App\Support\CollegeBrand::copy($callToAction->body) }}</p>
                        </div>
                        <a href="{{ $callToAction->button_url ?: $siteSettings->admissions_url ?: url('/#contact') }}">{{ \App\Support\CollegeBrand::copy($callToAction->button_label ?: 'Talk to Admissions') }} <span aria-hidden="true">&rarr;</span></a>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('partials.site-footer-modern')
</body>
</html>
