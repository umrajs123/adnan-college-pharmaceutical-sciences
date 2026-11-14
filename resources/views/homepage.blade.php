<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $siteSettings->site_description }}">
    <title>{{ $siteSettings->site_name }} | {{ $siteSettings->site_tagline }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="apple-touch-icon" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/scps.css') }}?v={{ filemtime(public_path('css/scps.css')) }}">
</head>
<body class="acps-site acps-public-page">
    @include('partials.site-header-modern')
    @include('partials.admissions-popup', ['settings' => $siteSettings])

    <main>
        <section class="acps-hero" aria-label="College introduction">
            <div class="acps-hero__stage" data-slider>
                @forelse($heroSlides as $slide)
                    <article data-hero-slide class="acps-hero__slide {{ $loop->first ? 'active' : '' }}">
                        <div class="acps-hero__copy">
                            <span class="acps-eyebrow">{{ \App\Support\CollegeBrand::copy($slide->eyebrow) }}</span>
                            <h1>{{ \App\Support\CollegeBrand::copy($slide->heading) }}</h1>
                            <p>{{ \App\Support\CollegeBrand::copy($slide->body) }}</p>
                            @if($slide->primary_label || $slide->secondary_label)
                                <div class="acps-hero__actions">
                                    @if($slide->primary_label)
                                        <a class="acps-button acps-button--primary" href="{{ $slide->primary_url ?: '#programs' }}">
                                            {{ \App\Support\CollegeBrand::copy($slide->primary_label) }}
                                            <span aria-hidden="true">&rarr;</span>
                                        </a>
                                    @endif
                                    @if($slide->secondary_label)
                                        <a class="acps-button acps-button--quiet" href="{{ $slide->secondary_url ?: '#about' }}">
                                            {{ \App\Support\CollegeBrand::copy($slide->secondary_label) }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="acps-hero__visual">
                            <img src="{{ $slide->imageUrl() }}" alt="{{ \App\Support\CollegeBrand::copy($slide->image_alt ?: $slide->heading) }}">
                            <div class="acps-hero__visual-shade"></div>
                            <div class="acps-hero__note">
                                <span class="acps-hero__note-mark" aria-hidden="true">+</span>
                                <span>Science-led learning. Care at the centre.</span>
                            </div>
                            <div class="acps-hero__image-caption">
                                <span>ADNAN COLLEGE OF</span>
                                <strong>Pharmaceutical Sciences</strong>
                            </div>
                            <div class="acps-hero__floating-card">
                                <span class="acps-hero__floating-icon" aria-hidden="true">Rx</span>
                                <span><strong>Knowledge with purpose</strong><small>Prepare to make a difference.</small></span>
                            </div>
                        </div>
                    </article>
                @empty
                    <article class="acps-hero__slide active">
                        <div class="acps-hero__copy">
                            <span class="acps-eyebrow">Adnan College of Pharmaceutical Sciences</span>
                            <h1>Learn with purpose. Grow into your future.</h1>
                            <p>Explore a pharmacy education shaped by scientific curiosity, practical learning, and a commitment to care.</p>
                            <div class="acps-hero__actions">
                                <a class="acps-button acps-button--primary" href="#programs">Explore programs <span aria-hidden="true">&rarr;</span></a>
                                <a class="acps-button acps-button--quiet" href="#about">Discover the college</a>
                            </div>
                        </div>
                        <div class="acps-hero__visual acps-hero__visual--placeholder" aria-hidden="true">
                            <div class="acps-hero__placeholder-mark">ACPS</div>
                        </div>
                    </article>
                @endforelse

                @if(($heroSlides ?? collect())->count() > 1)
                    <div class="acps-hero__controls" aria-label="Hero slides">
                        <button type="button" data-prev aria-label="Previous slide">&larr;</button>
                        <div class="acps-hero__dots" data-dots aria-label="Choose a slide"></div>
                        <button type="button" data-next aria-label="Next slide">&rarr;</button>
                    </div>
                @endif
            </div>
            <div class="acps-hero__edge" aria-hidden="true"></div>
        </section>

        <section class="acps-intro-strip" aria-label="Our approach">
            <div class="acps-container acps-intro-strip__inner">
                <p>
                    <span class="acps-intro-strip__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M9 3h6m-5 0v5l-4.1 7.1A3.3 3.3 0 0 0 8.8 20h6.4a3.3 3.3 0 0 0 2.9-4.9L14 8V3M8 14h8m-4-2v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <span class="acps-intro-strip__copy"><strong>01</strong> Learn through discovery</span>
                </p>
                <p>
                    <span class="acps-intro-strip__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M7.1 16.9a5.8 5.8 0 0 1 0-8.2l1.6-1.6a5.8 5.8 0 0 1 8.2 8.2l-1.6 1.6a5.8 5.8 0 0 1-8.2 0Z" stroke="currentColor" stroke-width="1.6"/><path d="m9 15 6-6m-7.9 1.4 6.5 6.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </span>
                    <span class="acps-intro-strip__copy"><strong>02</strong> Practice with purpose</span>
                </p>
                <p>
                    <span class="acps-intro-strip__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M20.2 8.6c0 5-8.2 10.1-8.2 10.1S3.8 13.6 3.8 8.6a4.5 4.5 0 0 1 8.2-2.5 4.5 4.5 0 0 1 8.2 2.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M5.2 11h3.2l1.4-2.4 2.1 5 1.5-2.6h5.3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <span class="acps-intro-strip__copy"><strong>03</strong> Lead with care</span>
                </p>
            </div>
        </section>

        @if($leadershipMessages->isNotEmpty())
            <section id="leadership" class="acps-section acps-leadership">
                <div class="acps-container">
                    <div class="acps-section__heading reveal">
                        <div>
                            <span class="acps-eyebrow">A message from our leaders</span>
                            <h2 class="acps-section__title">Guided by a clear sense of purpose.</h2>
                        </div>
                        <p class="acps-section__lead">Thoughtful leadership helps build a learning community grounded in curiosity, responsibility, and care.</p>
                    </div>
                    <div class="acps-leadership-grid">
                        @foreach($leadershipMessages as $message)
                            <article class="acps-leader-card reveal" data-leadership-message>
                                <div class="acps-leader-card__top">
                                    <div>
                                        <span>{{ \App\Support\CollegeBrand::copy($message->role) }}</span>
                                        <h3>{{ \App\Support\CollegeBrand::copy($message->title) }}</h3>
                                        @if($message->subtitle)
                                            <small>{{ \App\Support\CollegeBrand::copy($message->subtitle) }}</small>
                                        @endif
                                    </div>
                                    <img class="{{ $message->image_path ? '' : 'acps-logo-fallback' }}" src="{{ $message->imageUrl() }}" alt="{{ $message->image_path ? \App\Support\CollegeBrand::copy($message->role).' portrait' : $siteSettings->site_name.' logo' }}">
                                </div>
                                <div class="acps-leader-card__message">
                                    <p data-leadership-message-text>{{ \App\Support\CollegeBrand::copy($message->message) }}</p>
                                    <a href="{{ route('leadership.show', $message) }}" data-leadership-message-link hidden>Read the full message <span aria-hidden="true">&rarr;</span></a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section id="about" class="acps-section acps-about">
            <div class="acps-container acps-about__grid">
                @if($aboutSection)
                    <div class="acps-about__visual reveal">
                        <img src="{{ $aboutSection->imageUrl() }}" alt="{{ \App\Support\CollegeBrand::copy($aboutSection->image_alt ?: $aboutSection->heading) }}">
                        @if($aboutSection->badge_value || $aboutSection->badge_label)
                            <div class="acps-about__stamp">
                                @if($aboutSection->badge_value)
                                    <strong>{{ \App\Support\CollegeBrand::copy($aboutSection->badge_value) }}</strong>
                                @endif
                                @if($aboutSection->badge_label)
                                    <span>{{ \App\Support\CollegeBrand::copy($aboutSection->badge_label) }}</span>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="acps-about__copy reveal">
                        <span class="acps-eyebrow">{{ \App\Support\CollegeBrand::copy($aboutSection->eyebrow) }}</span>
                        <h2 class="acps-section__title">{{ \App\Support\CollegeBrand::copy($aboutSection->heading) }}</h2>
                        @if($aboutSection->body)
                            <p id="aboutBodyText" class="about-dynamic-body acps-section__body is-collapsed">{{ \App\Support\CollegeBrand::copy($aboutSection->body) }}</p>
                            <a class="about-dynamic-read-more acps-text-link" href="{{ route('about.show') }}" aria-label="Read the complete college story" hidden>Read the college story <span aria-hidden="true">&rarr;</span></a>
                        @endif
                        @if(! empty($aboutSection->features))
                            <ul class="acps-check-list">
                                @foreach($aboutSection->features as $feature)
                                    <li><span aria-hidden="true">&check;</span>{{ \App\Support\CollegeBrand::copy($feature['text'] ?? '') }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <a class="acps-button acps-button--outline" href="{{ $aboutSection->button_url ?: route('about.show') }}">
                            {{ \App\Support\CollegeBrand::copy($aboutSection->button_label ?: 'About the college') }}
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                @else
                    <div class="acps-about__copy reveal">
                        <span class="acps-eyebrow">About Adnan College</span>
                        <h2 class="acps-section__title">A place to learn with purpose and grow with confidence.</h2>
                        <p class="acps-section__body">Discover a pharmacy education that brings scientific foundations together with practical learning and a genuine commitment to care.</p>
                        <a class="acps-button acps-button--outline" href="{{ route('about.show') }}">Our story <span aria-hidden="true">&rarr;</span></a>
                    </div>
                @endif
            </div>
        </section>

        @if(($statCounters ?? collect())->isNotEmpty())
            <section id="stats" class="acps-metrics">
                <div class="acps-container acps-metrics__inner">
                    <div class="acps-metrics__intro">
                        <span class="acps-eyebrow">The college at a glance</span>
                        <h2>Small steps. Meaningful progress.</h2>
                    </div>
                    <div class="acps-metrics__grid">
                        @foreach($statCounters as $stat)
                            <article class="acps-metric">
                                <strong data-count="{{ $stat->value }}" data-count-prefix="{{ $stat->prefix }}" data-count-suffix="{{ $stat->suffix }}">0</strong>
                                <span>{{ \App\Support\CollegeBrand::copy($stat->label) }}</span>
                                @if($stat->description)
                                    <small>{{ \App\Support\CollegeBrand::copy($stat->description) }}</small>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section id="programs" class="acps-section acps-programs">
            <div class="acps-container">
                <div class="acps-section__heading reveal">
                    <div>
                        <span class="acps-eyebrow">Find your direction</span>
                        <h2 class="acps-section__title">Explore your academic pathway.</h2>
                    </div>
                    <p class="acps-section__lead">Build a strong foundation in pharmaceutical sciences with room to discover the work that inspires you.</p>
                </div>
                <div class="acps-program-grid">
                    @forelse($academicPrograms ?? collect() as $program)
                        <article class="acps-program-card reveal">
                            <span class="acps-program-card__number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            @if($program->icon_label)
                                <span class="acps-program-card__icon">{{ \App\Support\CollegeBrand::copy($program->icon_label) }}</span>
                            @endif
                            <h3>{{ \App\Support\CollegeBrand::copy($program->title) }}</h3>
                            <p>{{ \App\Support\CollegeBrand::copy($program->description ?: 'Program details will be updated soon.') }}</p>
                            <a href="{{ $program->publicUrl() }}" aria-label="Explore {{ $program->title }}">Explore program <span aria-hidden="true">&rarr;</span></a>
                        </article>
                    @empty
                        <div class="acps-empty-state">
                            <span class="acps-eyebrow">Programs</span>
                            <h3>Program information is on its way.</h3>
                            <p>Academic pathways will appear here as soon as they are published.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        @if(($academicFacilities ?? collect())->isNotEmpty())
            @php($featuredFacility = $academicFacilities->first())
            <section id="labs" class="acps-section acps-learning">
                <div class="acps-container">
                    <div class="acps-section__heading acps-learning__heading reveal">
                        <div>
                            <span class="acps-eyebrow">Learning in practice</span>
                            <h2 class="acps-section__title">Put knowledge into action.</h2>
                        </div>
                        <p class="acps-section__lead">Explore hands-on spaces where scientific principles connect with practical learning and professional curiosity.</p>
                    </div>

                    <div class="acps-learning__showcase">
                        <figure class="acps-learning__visual reveal">
                            <img src="{{ $featuredFacility->imageUrl() }}" alt="{{ \App\Support\CollegeBrand::copy($featuredFacility->image_alt ?: $featuredFacility->title) }}">
                            <span class="acps-learning__visual-tag">Practice-led learning</span>
                            <figcaption>
                                <span>Inside the college</span>
                                <strong>Curiosity grows through doing.</strong>
                            </figcaption>
                        </figure>

                        <div class="acps-learning__list">
                            @foreach($academicFacilities as $facility)
                                <article class="acps-learning__item reveal">
                                    <span class="acps-learning__number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>
                                        @if($facility->category)
                                            <span class="acps-learning__category">{{ \App\Support\CollegeBrand::copy($facility->category) }}</span>
                                        @endif
                                        <h3>{{ \App\Support\CollegeBrand::copy($facility->title) }}</h3>
                                        <p>{{ \App\Support\CollegeBrand::copy($facility->description ?: 'More information about this learning space will be available soon.') }}</p>
                                    </div>
                                    <span class="acps-learning__arrow" aria-hidden="true">&rarr;</span>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($campusLifeSection)
            <section id="campus" class="acps-section acps-campus">
                <div class="acps-container">
                    <div class="acps-section__heading reveal">
                        <div>
                            <span class="acps-eyebrow">{{ \App\Support\CollegeBrand::copy($campusLifeSection->eyebrow) }}</span>
                            <h2 class="acps-section__title">{{ \App\Support\CollegeBrand::copy($campusLifeSection->heading) }}</h2>
                        </div>
                        @if($campusLifeSection->body)
                            <p class="acps-section__lead">{{ \App\Support\CollegeBrand::copy($campusLifeSection->body) }}</p>
                        @endif
                    </div>
                    <div class="acps-campus-grid">
                        <article class="acps-campus-feature reveal">
                            <img src="{{ $campusLifeSection->imageUrl() }}" alt="{{ \App\Support\CollegeBrand::copy($campusLifeSection->image_alt ?: $campusLifeSection->heading) }}">
                            <div class="acps-campus-feature__shade"></div>
                            <div class="acps-campus-feature__copy">
                                @if($campusLifeSection->image_badge)
                                    <span>{{ \App\Support\CollegeBrand::copy($campusLifeSection->image_badge) }}</span>
                                @endif
                                @if($campusLifeSection->image_heading)
                                    <h3>{{ \App\Support\CollegeBrand::copy($campusLifeSection->image_heading) }}</h3>
                                @endif
                            </div>
                        </article>
                        <div class="acps-campus-list">
                            @foreach($campusLifeSection->cards ?: [] as $card)
                                <article class="acps-campus-card reveal">
                                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>
                                        <h3>{{ \App\Support\CollegeBrand::copy($card['title'] ?? '') }}</h3>
                                        @if(! empty($card['text']))
                                            <p>{{ \App\Support\CollegeBrand::copy($card['text']) }}</p>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    @if(! empty($campusLifeSection->highlights))
                        <div class="acps-campus-highlights">
                            @foreach($campusLifeSection->highlights as $highlight)
                                <div class="acps-campus-highlight reveal">
                                    <span>{{ \App\Support\CollegeBrand::copy($highlight['label'] ?? '') }}</span>
                                    <strong>{{ \App\Support\CollegeBrand::copy($highlight['value'] ?? '') }}</strong>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <section id="faculty" class="acps-section acps-faculty">
            <div class="acps-container">
                <div class="acps-section__heading reveal">
                    <div>
                        <span class="acps-eyebrow">People who make the difference</span>
                        <h2 class="acps-section__title">Learn alongside dedicated mentors.</h2>
                    </div>
                    @if($homeFaculty->isNotEmpty())
                        <a class="acps-text-link" href="{{ route('faculty.index') }}">Meet the faculty <span aria-hidden="true">&rarr;</span></a>
                    @endif
                </div>
                <div class="acps-faculty-grid">
                    @forelse($homeFaculty as $member)
                        <a href="{{ route('faculty.show', $member->slug) }}" class="acps-faculty-card reveal">
                            <div class="acps-faculty-card__image">
                                <img class="{{ $member->image_path ? '' : 'acps-logo-fallback' }}" src="{{ $member->imageUrl() }}" alt="{{ $member->image_path ? $member->name : $siteSettings->site_name.' logo' }}">
                            </div>
                            <div class="acps-faculty-card__copy">
                                <span>{{ \App\Support\CollegeBrand::copy($member->department) }}</span>
                                <h3>{{ $member->name }}</h3>
                                <p>{{ preg_replace('/\s*\/\s*/', '/ ', \Illuminate\Support\Str::title(mb_strtolower($member->designation))) }}</p>
                                <span class="acps-faculty-card__link">View profile <span aria-hidden="true">&rarr;</span></span>
                            </div>
                        </a>
                    @empty
                        <div class="acps-empty-state">
                            <span class="acps-eyebrow">Faculty</span>
                            <h3>Meet our faculty soon.</h3>
                            <p>Faculty profiles will appear here when they are published.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        @if(($studentVoices ?? collect())->isNotEmpty())
            <section class="acps-section acps-voices" data-testimonial-slider>
                <div class="acps-container">
                    <div class="acps-section__heading reveal">
                        <div>
                            <span class="acps-eyebrow">Student perspectives</span>
                            <h2 class="acps-section__title">A community grows together.</h2>
                        </div>
                        @if($studentVoices->count() > 1)
                            <div class="acps-carousel-controls">
                                <button type="button" data-testimonial-prev aria-label="Previous student story">&larr;</button>
                                <button type="button" data-testimonial-next aria-label="Next student story">&rarr;</button>
                            </div>
                        @endif
                    </div>
                    <div class="acps-voice-stage" data-testimonial-stage>
                        @foreach($studentVoices as $voice)
                            <article class="acps-voice-card {{ $loop->first ? '' : 'absolute inset-0 pointer-events-none opacity-0 translate-x-6' }} {{ $loop->first ? 'opacity-100 translate-x-0' : '' }}" data-testimonial-slide>
                                <div class="acps-voice-card__person">
                                    <img class="{{ $voice->image_path ? '' : 'acps-logo-fallback' }}" src="{{ $voice->imageUrl() }}" alt="{{ $voice->image_path ? \App\Support\CollegeBrand::copy($voice->image_alt ?: $voice->name) : $siteSettings->site_name.' logo' }}">
                                    <strong>{{ \App\Support\CollegeBrand::copy($voice->name) }}</strong>
                                    @if($voice->program)
                                        <span>{{ \App\Support\CollegeBrand::copy($voice->program) }}</span>
                                    @endif
                                </div>
                                <div class="acps-voice-card__story">
                                    <span class="acps-voice-card__quote-mark" aria-hidden="true">&ldquo;</span>
                                    <blockquote>{{ \App\Support\CollegeBrand::copy($voice->quote) }}</blockquote>
                                    @if(! empty($voice->highlights))
                                        <div class="acps-voice-highlights">
                                            @foreach($voice->highlights as $highlight)
                                                <div>
                                                    @if(! empty($highlight['title']))
                                                        <strong>{{ \App\Support\CollegeBrand::copy($highlight['title']) }}</strong>
                                                    @endif
                                                    @if(! empty($highlight['text']))
                                                        <span>{{ \App\Support\CollegeBrand::copy($highlight['text']) }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                    @if($studentVoices->count() > 1)
                        <div class="acps-voice-dots" aria-label="Choose a student story">
                            @foreach($studentVoices as $voice)
                                <button type="button" data-testimonial-dot aria-label="Show student story {{ $loop->iteration }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <section class="acps-section acps-updates">
            <div class="acps-container acps-updates__grid">
                <div id="events" class="acps-updates__column">
                    <div class="acps-section__heading reveal">
                        <div>
                            <span class="acps-eyebrow">On the calendar</span>
                            <h2 class="acps-section__title">Coming together.</h2>
                        </div>
                        <a class="acps-text-link" href="{{ route('events.index') }}">All events <span aria-hidden="true">&rarr;</span></a>
                    </div>
                    <div class="acps-event-list">
                        @forelse($campusEvents as $event)
                            <article class="acps-event-card reveal">
                                <time datetime="{{ $event->starts_at->toDateString() }}">
                                    <strong>{{ $event->starts_at->format('d') }}</strong>
                                    <span>{{ $event->starts_at->format('M') }}</span>
                                </time>
                                <div>
                                    <span>{{ \App\Support\CollegeBrand::copy($event->category) }}</span>
                                    <h3>{{ \App\Support\CollegeBrand::copy($event->title) }}</h3>
                                    <p>{{ \App\Support\CollegeBrand::copy($event->venue ?: 'Campus') }} &middot; {{ $event->starts_at->format('h:i A') }}</p>
                                </div>
                            </article>
                        @empty
                            <div class="acps-empty-state">
                                <h3>New events will be announced here.</h3>
                                <p>Check back for campus gatherings, seminars, and academic sessions.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div id="news" class="acps-updates__column">
                    <div class="acps-section__heading reveal">
                        <div>
                            <span class="acps-eyebrow">From the college</span>
                            <h2 class="acps-section__title">News &amp; notices.</h2>
                        </div>
                        <a class="acps-text-link" href="{{ route('news.index') }}">All news <span aria-hidden="true">&rarr;</span></a>
                    </div>
                    <div class="acps-news-list">
                        @forelse($newsPosts as $post)
                            <article class="acps-news-card reveal">
                                <img src="{{ $post->imageUrl() }}" alt="{{ \App\Support\CollegeBrand::copy($post->image_alt ?: $post->title) }}">
                                <div>
                                    <span>{{ optional($post->published_at)->format('M d, Y') ?: \App\Support\CollegeBrand::copy($post->category) }}</span>
                                    <h3>{{ \App\Support\CollegeBrand::copy($post->title) }}</h3>
                                    @if($post->excerpt)
                                        <p>{{ \App\Support\CollegeBrand::copy($post->excerpt) }}</p>
                                    @endif
                                    <a href="{{ route('news.show', $post->slug) }}">Read update <span aria-hidden="true">&rarr;</span></a>
                                </div>
                            </article>
                        @empty
                            <div class="acps-empty-state">
                                <h3>College news will appear here.</h3>
                                <p>Announcements and updates will be shared as they are published.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section id="admissions" class="acps-admissions">
            <div class="acps-container acps-admissions__inner reveal">
                <div>
                    <span class="acps-eyebrow">Your next chapter</span>
                    <h2>Make room for a future in pharmacy.</h2>
                    <p>Take the next step with guidance from our admissions team.</p>
                </div>
                <div class="acps-admissions__actions">
                    <a class="acps-button acps-button--light" href="{{ $siteSettings->admissions_url ?: '#contact' }}">Explore admissions <span aria-hidden="true">&rarr;</span></a>
                    <a class="acps-admissions__contact" href="#contact">Talk to the college</a>
                </div>
            </div>
        </section>
    </main>

    @include('partials.site-footer-modern')
</body>
</html>
