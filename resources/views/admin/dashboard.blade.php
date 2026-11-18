@extends('admin.layouts.app')

@section('title', 'ACPS Admin Dashboard')
@section('eyebrow', 'Website Overview')
@section('page_title', 'Dashboard')

@section('content')
    @php
        $publishedTotal = $activeHeroSlideCount
            + $activeFacultyCount
            + $activeEventCount
            + $activeNewsCount
            + $activeLeadershipCount
            + $activeProgramCount
            + $activeStatCount
            + $activeStudentVoiceCount
            + $activeFacilityCount
            + $activeAboutCount
            + $activeCampusLifeCount;

        $draftTotal = ($heroSlideCount - $activeHeroSlideCount)
            + ($facultyCount - $activeFacultyCount)
            + ($eventCount - $activeEventCount)
            + ($newsCount - $activeNewsCount)
            + ($leadershipCount - $activeLeadershipCount)
            + ($programCount - $activeProgramCount)
            + ($statCount - $activeStatCount)
            + ($studentVoiceCount - $activeStudentVoiceCount)
            + ($facilityCount - $activeFacilityCount)
            + ($aboutCount - $activeAboutCount)
            + ($campusLifeCount - $activeCampusLifeCount);

        $contentChart = collect([
            ['label' => 'Hero Slides', 'total' => $heroSlideCount, 'active' => $activeHeroSlideCount],
            ['label' => 'Faculty', 'total' => $facultyCount, 'active' => $activeFacultyCount],
            ['label' => 'Events', 'total' => $eventCount, 'active' => $activeEventCount],
            ['label' => 'News', 'total' => $newsCount, 'active' => $activeNewsCount],
            ['label' => 'Leadership', 'total' => $leadershipCount, 'active' => $activeLeadershipCount],
            ['label' => 'Programs', 'total' => $programCount, 'active' => $activeProgramCount],
            ['label' => 'Stats', 'total' => $statCount, 'active' => $activeStatCount],
            ['label' => 'Voices', 'total' => $studentVoiceCount, 'active' => $activeStudentVoiceCount],
            ['label' => 'Facilities', 'total' => $facilityCount, 'active' => $activeFacilityCount],
            ['label' => 'About', 'total' => $aboutCount, 'active' => $activeAboutCount],
            ['label' => 'Campus Life', 'total' => $campusLifeCount, 'active' => $activeCampusLifeCount],
        ]);

        $maxChartTotal = max(1, $contentChart->max('total'));
        $chartCount = max(1, $contentChart->count() - 1);
        $chartMax = max(1, $contentChart->max(fn ($item) => max($item['total'], $item['active'])));
        $plotTop = 28;
        $plotBottom = 222;
        $plotHeight = $plotBottom - $plotTop;
        $totalPoints = $contentChart->values()->map(function ($item, $index) use ($chartCount, $chartMax, $plotBottom, $plotHeight) {
            $x = round(($index / $chartCount) * 1000, 2);
            $y = round($plotBottom - (($item['total'] / $chartMax) * $plotHeight), 2);
            return $x.','.$y;
        })->implode(' ');
        $activePoints = $contentChart->values()->map(function ($item, $index) use ($chartCount, $chartMax, $plotBottom, $plotHeight) {
            $x = round(($index / $chartCount) * 1000, 2);
            $y = round($plotBottom - (($item['active'] / $chartMax) * $plotHeight), 2);
            return $x.','.$y;
        })->implode(' ');
    @endphp

    <section class="admin-status-strip">
        <div>
            <span>{{ now()->format('l, F d') }}</span>
            <h2>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}. Your website content is ready to manage.</h2>
        </div>
        <div class="admin-status-strip__metrics">
            <article>
                <strong>{{ $publishedTotal }}</strong>
                <small>Published items</small>
            </article>
            <article>
                <strong>{{ $draftTotal }}</strong>
                <small>Hidden drafts</small>
            </article>
        </div>
    </section>

    <a class="admissions-popup-dashboard" href="{{ route('admin.admissions-popup.edit') }}">
        <div>
            <span class="admin-kicker">Featured Website Announcement</span>
            <h2>Admissions Popup</h2>
            <p>Edit the message visitors see when they arrive, update the Apply Now link, or switch the popup on and off.</p>
        </div>
        <div class="admissions-popup-dashboard__action">
            <span class="admissions-popup-admin-preview__status {{ $siteSettings->admissions_popup_is_active ? 'is-active' : 'is-inactive' }}">
                {{ $siteSettings->admissions_popup_is_active ? 'Active' : 'Inactive' }}
            </span>
            <strong>Manage popup <span aria-hidden="true">&rarr;</span></strong>
        </div>
    </a>

    <section class="admin-stats">
        <article>
            <span>{{ $heroSlideCount }}</span>
            <strong>Hero slides</strong>
            <small>{{ $activeHeroSlideCount }} active slides appear in the homepage hero.</small>
        </article>
        <article>
            <span>{{ $facultyCount }}</span>
            <strong>Faculty profiles</strong>
            <small>{{ $activeFacultyCount }} active profiles are visible publicly.</small>
        </article>
        <article>
            <span>{{ $eventCount }}</span>
            <strong>Campus events</strong>
            <small>{{ $activeEventCount }} active events are visible on the homepage.</small>
        </article>
        <article>
            <span>{{ $newsCount }}</span>
            <strong>News posts</strong>
            <small>{{ $activeNewsCount }} active posts are visible publicly.</small>
        </article>
        <article>
            <span>{{ $leadershipCount }}</span>
            <strong>Leadership records</strong>
            <small>{{ $activeLeadershipCount }} active messages are visible publicly.</small>
        </article>
        <article>
            <span>{{ $programCount }}</span>
            <strong>Academic programs</strong>
            <small>{{ $activeProgramCount }} active programs are visible on the homepage.</small>
        </article>
        <article>
            <span>{{ $statCount }}</span>
            <strong>Stats counters</strong>
            <small>{{ $activeStatCount }} active counters animate on the homepage.</small>
        </article>
        <article>
            <span>{{ $studentVoiceCount }}</span>
            <strong>Student voices</strong>
            <small>{{ $activeStudentVoiceCount }} active testimonials appear in the slider.</small>
        </article>
        <article>
            <span>{{ $facilityCount }}</span>
            <strong>Facilities</strong>
            <small>{{ $activeFacilityCount }} active facility cards appear in the carousel.</small>
        </article>
        <article>
            <span>{{ $aboutCount }}</span>
            <strong>About blocks</strong>
            <small>{{ $activeAboutCount }} active About blocks are available for the homepage.</small>
        </article>
        <article>
            <span>{{ $campusLifeCount }}</span>
            <strong>Campus Life</strong>
            <small>{{ $activeCampusLifeCount }} active Campus Life section is available for the homepage.</small>
        </article>
    </section>

    <section class="admin-content-graph admin-content-line-graph">
        <div class="admin-card-head">
            <div>
                <span class="admin-kicker">Content Analytics</span>
                <h2>Publishing momentum</h2>
                <p>A visual snapshot of every content area, comparing what is published with the full library.</p>
            </div>
            <div class="admin-graph-legend">
                <span><i></i> Published</span>
                <span><i></i> Total</span>
            </div>
        </div>

        <div class="admin-analytics-summary">
            <div><small>Published now</small><strong>{{ $publishedTotal }}</strong><span>live records</span></div>
            <div><small>Content library</small><strong>{{ $publishedTotal + $draftTotal }}</strong><span>total records</span></div>
            <div><small>Visibility rate</small><strong>{{ $publishedTotal + $draftTotal > 0 ? round(($publishedTotal / ($publishedTotal + $draftTotal)) * 100) : 0 }}%</strong><span>published</span></div>
        </div>

        <div class="admin-line-chart-wrap">
            <div class="admin-line-chart-scale">
                <span>{{ $chartMax }}</span>
                <span>{{ round($chartMax / 2) }}</span>
                <span>0</span>
            </div>
            <div class="admin-line-chart">
                <svg viewBox="0 0 1000 260" role="img" aria-label="Published and total content line graph" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="adminPublishedLine" x1="0" x2="1" y1="0" y2="0">
                            <stop offset="0%" stop-color="#0ea5e9" />
                            <stop offset="100%" stop-color="#14b8a6" />
                        </linearGradient>
                        <linearGradient id="adminPublishedArea" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#0ea5e9" stop-opacity="0.22" />
                            <stop offset="100%" stop-color="#0ea5e9" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <g class="admin-line-chart__grid">
                        <line x1="0" y1="28" x2="1000" y2="28" />
                        <line x1="0" y1="125" x2="1000" y2="125" />
                        <line x1="0" y1="222" x2="1000" y2="222" />
                    </g>
                    <polygon class="admin-line-chart__area" points="{{ $activePoints }} 1000,222 0,222"></polygon>
                    <polyline class="admin-line-chart__total" points="{{ $totalPoints }}"></polyline>
                    <polyline class="admin-line-chart__active" points="{{ $activePoints }}"></polyline>
                    @foreach($contentChart->values() as $item)
                        @php
                            $x = round(($loop->index / $chartCount) * 1000, 2);
                            $activeY = round($plotBottom - (($item['active'] / $chartMax) * $plotHeight), 2);
                            $totalY = round($plotBottom - (($item['total'] / $chartMax) * $plotHeight), 2);
                        @endphp
                        <circle class="admin-line-chart__dot admin-line-chart__dot--total" cx="{{ $x }}" cy="{{ $totalY }}" r="5"></circle>
                        <circle class="admin-line-chart__dot admin-line-chart__dot--active" cx="{{ $x }}" cy="{{ $activeY }}" r="6"></circle>
                    @endforeach
                </svg>
            </div>
        </div>

        <div class="admin-line-chart-labels">
            @foreach($contentChart as $item)
                <span title="{{ $item['label'] }}">{{ \Illuminate\Support\Str::limit($item['label'], 10, '') }}</span>
            @endforeach
        </div>
    </section>

    <section class="admin-developer-card" aria-labelledby="adminDeveloperTitle">
        <div class="admin-developer-card__identity">
            <img class="admin-developer-card__avatar" src="{{ asset('images/adnan-umraj.webp') }}" alt="Adnan K Umraj">
            <div>
                <span class="admin-kicker">Website developer</span>
                <h2 id="adminDeveloperTitle">Adnan K Umraj</h2>
            </div>
        </div>
        <div class="admin-developer-card__links">
            <a href="mailto:umrajs123@gmail.com"><span class="admin-developer-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m4 7 8 6 8-6"></path></svg></span><small>Email</small><strong>umrajs123@gmail.com</strong></a>
            <a href="https://wa.me/923433946559" target="_blank" rel="noopener noreferrer"><span class="admin-developer-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4A8 8 0 1 1 20 11.5Z"></path><path d="M8.2 8.5c.2-.4.4-.4.7-.4h.5c.2 0 .3.1.4.4l.6 1.4c.1.2.1.4-.1.6l-.5.5c.5 1 1.3 1.7 2.3 2.2l.6-.5c.2-.2.4-.2.6-.1l1.4.6c.3.1.4.3.3.6-.2.7-.7 1.2-1.4 1.3-1.4.1-3.2-.8-4.5-2.1-1.2-1.2-2-2.8-1.9-4.5.1-.3.5-.7 1-1Z"></path></svg></span><small>WhatsApp</small><strong>+92 343 3946559</strong></a>
            <a href="https://github.com/umrajs123" target="_blank" rel="noopener noreferrer"><span class="admin-developer-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M9 19c-4 .9-4-2-5-2m10 4v-3.5c0-1 .1-1.4-.5-2 1.8-.2 3.7-.9 3.7-4a3.1 3.1 0 0 0-.8-2.2 2.9 2.9 0 0 0-.1-2.2s-.7-.2-2.3.8a8 8 0 0 0-4.1 0c-1.6-1-2.3-.8-2.3-.8a2.9 2.9 0 0 0-.1 2.2 3.1 3.1 0 0 0-.8 2.2c0 3.1 1.9 3.8 3.7 4-.6.5-.6 1-.5 2V21"></path></svg></span><small>GitHub</small><strong>github.com/umrajs123</strong></a>
        </div>
        <p class="admin-developer-card__note">Need an update, improvement, or a new feature? Contact me directly.</p>
    </section>
@endsection
