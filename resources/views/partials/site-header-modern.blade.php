@php
    $homeUrl = url('/');
    $settings = $siteSettings ?? \App\Models\SiteSetting::current();
    $admissionsUrl = $settings->admissions_url ?: '#admissions';
    $isHome = request()->is('/');
    $isNursing = request()->routeIs('nursing.*');
@endphp

<div class="preloader" aria-hidden="true">
    <div class="preloader__mark"><img src="{{ $settings->logoUrl() }}" alt=""></div>
</div>

<header id="siteHeader" class="acps-header">
    <nav class="acps-container" aria-label="Primary navigation">
        <div class="acps-header__inner">
            <a class="acps-brand" href="{{ $homeUrl }}" aria-label="{{ $settings->site_name }} home">
                <span class="acps-brand__mark"><img src="{{ $settings->logoUrl() }}" alt=""></span>
                <span class="acps-brand__copy">
                    <strong>{{ $settings->site_name }}</strong>
                    <small>Pharmaceutical Sciences <span aria-hidden="true">·</span> ACPS</small>
                </span>
            </a>

            <ul class="acps-nav">
                <li><a href="{{ $homeUrl }}" @if($isHome) aria-current="page" @endif>Home</a></li>
                <li><a href="{{ $homeUrl }}#about">About</a></li>
                <li><a href="{{ $homeUrl }}#programs">Programs</a></li>
                <li><a href="{{ $homeUrl }}#campus">Campus life</a></li>
                <li><a href="{{ route('nursing.index') }}" class="nursing-nav-link" @if($isNursing) aria-current="page" @endif>Nursing <span class="nursing-nav-indicator" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M10 5v10M5 10h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span></a></li>
                <li><a href="{{ route('faculty.index') }}">Faculty</a></li>
                <li><a href="{{ route('news.index') }}">News</a></li>
            </ul>

            <div class="acps-header__actions">
                <button class="acps-search-button" type="button" data-open-search aria-label="Search the website">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-3.5-3.5"></path>
                    </svg>
                </button>
                <a class="acps-header__apply" href="{{ $admissionsUrl }}">Apply <span aria-hidden="true">&rarr;</span></a>
            </div>

            <button class="nav-toggle acps-menu-toggle" type="button" aria-label="Open menu" aria-controls="mobileMenu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>
</header>

<aside class="mobile-menu acps-mobile-menu" id="mobileMenu" aria-hidden="true">
    <div class="mobile-menu__panel acps-mobile-menu__panel">
        <div class="mobile-menu__head acps-mobile-menu__head">
            <a class="acps-brand" href="{{ $homeUrl }}">
                <span class="acps-brand__mark"><img src="{{ $settings->logoUrl() }}" alt=""></span>
                <span class="acps-brand__copy"><strong>{{ $settings->site_name }}</strong><small>Pharmaceutical Sciences <span aria-hidden="true">·</span> ACPS</small></span>
            </a>
            <button class="mobile-close acps-mobile-menu__close" type="button" aria-label="Close menu">&times;</button>
        </div>
        <a href="{{ $homeUrl }}">Home</a>
        <a href="{{ $homeUrl }}#about">About the college</a>
        <a href="{{ $homeUrl }}#programs">Academic programs</a>
        <a href="{{ route('nursing.index') }}">Nursing</a>
        <a href="{{ route('faculty.index') }}">Faculty</a>
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('news.index') }}">News</a>
        <a href="{{ $homeUrl }}#contact">Contact</a>
        <button class="acps-mobile-menu__search" type="button" data-open-search>Search the website <span aria-hidden="true">&rarr;</span></button>
        <a class="acps-mobile-menu__apply" href="{{ $admissionsUrl }}">Admissions <span aria-hidden="true">&rarr;</span></a>
    </div>
</aside>

<div class="search-modal acps-search-modal" aria-hidden="true">
    <button class="search-modal__close" type="button" aria-label="Close search">&times;</button>
    <form class="search-modal__box" method="GET" action="{{ route('search.index') }}">
        <label for="siteSearch">Search the college</label>
        <div>
            <input id="siteSearch" name="q" type="search" placeholder="Programs, faculty, campus life..." required>
            <button type="submit">Search</button>
        </div>
    </form>
</div>
