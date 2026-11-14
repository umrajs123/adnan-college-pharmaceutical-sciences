<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $message->title }} — a message from the {{ $message->role }} at {{ $siteSettings->site_name }}.">
    <title>{{ $message->title }} - {{ $siteSettings->site_name }}</title>
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

    <main class="leadership-detail leadership-detail--{{ $message->accent }}">
        <section class="leadership-detail__hero">
            <div class="acps-container leadership-detail__hero-inner">
                <figure class="leadership-detail__portrait">
                    <img src="{{ $message->imageUrl() }}" alt="{{ $message->role }} portrait">
                    <figcaption>{{ $message->role }} <span aria-hidden="true">·</span> College leadership</figcaption>
                </figure>

                <div class="leadership-detail__intro">
                    <a href="{{ url('/') }}#leadership" class="leadership-detail__back">
                        <span aria-hidden="true">&larr;</span> Leadership Messages
                    </a>
                    <span class="leadership-detail__eyebrow">A message from our leaders</span>
                    <span class="leadership-detail__role">{{ $message->role }}</span>
                    <h1>{{ $message->title }}</h1>
                    @if($message->subtitle)
                        <p class="leadership-detail__subtitle">{{ $message->subtitle }}</p>
                    @endif
                    <span class="leadership-detail__institution">{{ $siteSettings->site_name }}</span>
                </div>
            </div>
        </section>

        <section class="leadership-detail__content">
            <div class="acps-container leadership-detail__content-inner">
                <aside class="leadership-detail__sidebar">
                    <span class="leadership-detail__label">Leadership perspective</span>
                    <h2>Guided by purpose.</h2>
                    <p>Our college community is built on thoughtful learning, professional growth, and care for others.</p>
                    @if(! empty($message->tags))
                        <div class="leadership-detail__tags">
                            @foreach($message->tags as $tag)
                                <span>{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </aside>

                <article class="leadership-detail__message">
                    <span class="leadership-detail__message-kicker">A message from the {{ $message->role }}</span>
                    <div class="leadership-detail__text">{{ $message->message }}</div>
                    <div class="leadership-detail__signoff">
                        <span aria-hidden="true"></span>
                        <div>
                            <strong>{{ $message->role }}</strong>
                            <small>{{ $siteSettings->site_name }}</small>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>

    @include('partials.site-footer-modern')
</body>
</html>
