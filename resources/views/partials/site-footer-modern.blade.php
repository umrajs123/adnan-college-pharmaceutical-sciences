@php
    $homeUrl = url('/');
    $settings = $siteSettings ?? \App\Models\SiteSetting::current();
    $admissionsUrl = $settings->admissions_url ?: '#admissions';
    $contactEmail = $settings->email;
    $lastUpdatedAt = max(
        filemtime(resource_path('views/homepage.blade.php')),
        filemtime(public_path('css/scps.css')),
        filemtime(public_path('js/scps.js'))
    );
@endphp

<footer id="contact" class="acps-footer">
    <div class="acps-container">
        <div class="acps-footer__callout">
            <div class="acps-footer__hero-copy">
                <span class="acps-footer__eyebrow">{{ $settings->site_name }} <i aria-hidden="true"></i> {{ $settings->address }}</span>
                <h2>Learn with purpose.<br>Grow with care.</h2>
                <p>{{ $settings->site_description }}</p>
                <a class="acps-footer__callout-link" href="{{ $admissionsUrl }}">Explore admissions <span aria-hidden="true">&rarr;</span></a>
            </div>
            <div class="acps-footer__hero-art" aria-hidden="true">
                <span class="acps-footer__hero-orbit acps-footer__hero-orbit--outer"></span>
                <span class="acps-footer__hero-orbit acps-footer__hero-orbit--inner"></span>
                <img src="{{ $settings->logoUrl() }}" alt="">
                <span class="acps-footer__hero-caption">{{ $settings->site_tagline }}</span>
            </div>
        </div>

        <div class="acps-footer__main">
            <div class="acps-footer__identity">
                <a class="acps-brand acps-brand--footer" href="{{ $homeUrl }}">
                    <span class="acps-brand__copy">
                        <strong>{{ $settings->site_name }}</strong>
                        <small>Pharmaceutical Sciences <span aria-hidden="true">·</span> ACPS</small>
                    </span>
                </a>
                <p>{{ $settings->site_description }}</p>
                <div class="acps-footer__socials">
                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" aria-label="Facebook" target="_blank" rel="noopener noreferrer">f</a>
                    @endif
                    @if($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">in</a>
                    @endif
                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" aria-label="YouTube" target="_blank" rel="noopener noreferrer">yt</a>
                    @endif
                </div>
            </div>

            <div class="acps-footer__column">
                <h2>Explore</h2>
                <a href="{{ $homeUrl }}#about">About the college</a>
                <a href="{{ $homeUrl }}#programs">Academic programs</a>
                <a href="{{ route('faculty.index') }}">Faculty</a>
                <a href="{{ $homeUrl }}#campus">Campus life</a>
            </div>

            <div class="acps-footer__column">
                <h2>Information</h2>
                <a href="{{ route('events.index') }}">Events</a>
                <a href="{{ route('news.index') }}">News &amp; notices</a>
                <a href="{{ route('nursing.index') }}">Nursing</a>
                <a href="{{ $admissionsUrl }}">Admissions</a>
            </div>

            <div class="acps-footer__column acps-footer__contact">
                <h2>Get in touch</h2>
                <p>{{ $settings->address }}</p>
                @if($settings->phone)
                    <a href="{{ $settings->phoneHref() }}">{{ $settings->phone }}</a>
                @endif
                @if($contactEmail)
                    <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                @else
                    <p>Email contact details to be confirmed.</p>
                @endif
            </div>
        </div>

        <div class="acps-footer__bottom">
            <span>&copy; {{ now()->year }} {{ $settings->site_name }}. All rights reserved.</span>
            <small class="acps-footer__updated">Website was last updated on {{ \Carbon\Carbon::createFromTimestamp($lastUpdatedAt, config('app.timezone'))->format('h:i A') }} time, and {{ \Carbon\Carbon::createFromTimestamp($lastUpdatedAt, config('app.timezone'))->format('d.m.y') }} date.</small>
            <a class="developer-contact-trigger acps-footer__credit" href="#developerContactModal" aria-haspopup="dialog" aria-controls="developerContactModal">
                <span class="acps-footer__credit-label">Website by</span>
                <strong>Adnan K Umraj</strong>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>
</footer>

<dialog id="developerContactModal" class="developer-contact-modal" aria-labelledby="developerContactTitle" aria-describedby="developerContactDescription">
    <div class="developer-contact-card">
        <button class="developer-contact-close" type="button" aria-label="Close contact details" data-close-developer-contact>&times;</button>
        <div class="developer-contact-avatar" aria-hidden="true">
            <img src="{{ asset('images/adnan-umraj.webp') }}" alt="">
        </div>
        <p class="developer-contact-eyebrow">Independent web developer</p>
        <h2 id="developerContactTitle">Adnan K Umraj</h2>
        <p id="developerContactDescription" class="developer-contact-intro">Have a project in mind? Get in touch and let’s build something great for you.</p>
        <div class="developer-contact-links">
            <a href="mailto:umrajs123@gmail.com" class="developer-contact-link">
                <span class="developer-contact-icon" aria-hidden="true">@</span>
                <span><small>Email</small><strong>umrajs123@gmail.com</strong></span>
                <span class="developer-contact-arrow" aria-hidden="true">&nearr;</span>
            </a>
            <a href="https://wa.me/923433946559" class="developer-contact-link" target="_blank" rel="noopener noreferrer">
                <span class="developer-contact-icon developer-contact-icon--whatsapp" aria-hidden="true">WA</span>
                <span><small>WhatsApp</small><strong>+92 343 3946559</strong></span>
                <span class="developer-contact-arrow" aria-hidden="true">&nearr;</span>
            </a>
            <a href="https://github.com/umrajs123" class="developer-contact-link" target="_blank" rel="noopener noreferrer">
                <span class="developer-contact-icon developer-contact-icon--github" aria-hidden="true">GH</span>
                <span><small>GitHub</small><strong>github.com/umrajs123</strong></span>
                <span class="developer-contact-arrow" aria-hidden="true">&nearr;</span>
            </a>
        </div>
    </div>
</dialog>

<button class="back-to-top acps-back-to-top" type="button" aria-label="Back to top">&uarr;</button>

<script src="{{ asset('js/scps.js') }}?v={{ filemtime(public_path('js/scps.js')) }}"></script>
@include('partials.college-assistant')
