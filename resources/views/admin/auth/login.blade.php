<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACPS Admin Login</title>
    <link rel="icon" type="image/png" href="{{ $siteSettings->faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body class="admin-login">
    @php
        $lockoutSeconds = (int) session('lockout_seconds', 0);
    @endphp

    <section class="login-card">
        <div class="login-card__visual">
            <div class="login-card__brand">
                <img src="{{ $siteSettings->logoUrl() }}" alt="{{ $siteSettings->site_name }} logo">
                <div>
                    <strong>{{ $siteSettings->site_name }}</strong>
                    <small>{{ $siteSettings->site_tagline }}</small>
                </div>
            </div>
            <div class="login-card__message">
                <span>Website Administration</span>
                <h1>Thoughtful tools for a purposeful college.</h1>
                <p>Keep programs, people, campus stories, and admissions information clear and current from one focused workspace.</p>
            </div>
            <div class="login-card__features" aria-label="Admin workspace highlights">
                <span>Content</span><span>Admissions</span><span>People</span>
            </div>
        </div>

        <form class="login-card__form" method="POST" action="{{ route('admin.login.store') }}" data-login-form data-lockout-seconds="{{ $lockoutSeconds }}">
            @csrf
            <span class="admin-kicker">Secure Login</span>
            <h2>Welcome back.</h2>
            <p>Sign in to manage the Adnan College website.</p>

            @if($lockoutSeconds > 0)
                <div class="login-cooldown" data-login-cooldown>
                    <strong>Cooling down</strong>
                    <span>Please wait <b data-login-countdown>{{ $lockoutSeconds }}</b> seconds before trying again.</span>
                </div>
            @endif

            <label>
                Email Address
                <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus @disabled($lockoutSeconds > 0)>
            </label>

            <label>
                Password
                <input type="password" name="password" autocomplete="current-password" required @disabled($lockoutSeconds > 0)>
            </label>

            <label class="admin-check">
                <input type="checkbox" name="remember" value="1" @disabled($lockoutSeconds > 0)>
                <span>Keep me signed in</span>
            </label>

            @error('email')
                <div class="admin-error" data-login-lockout-error>{{ $message }}</div>
            @enderror

            <button type="submit" @disabled($lockoutSeconds > 0)>Enter Admin Panel</button>
            <a class="login-card__return" href="{{ url('/') }}">&larr; Return to the college website</a>
        </form>
    </section>

    <script>
        (() => {
            const form = document.querySelector('[data-login-form]');
            if (!form) return;

            let seconds = Number(form.dataset.lockoutSeconds || 0);
            if (seconds <= 0) return;

            const countdown = form.querySelector('[data-login-countdown]');
            const controls = [...form.querySelectorAll('input, button')];

            const tick = () => {
                if (countdown) countdown.textContent = seconds;

                if (seconds <= 0) {
                    controls.forEach((control) => control.disabled = false);
                    form.querySelector('[data-login-cooldown]')?.remove();
                    form.querySelector('[data-login-lockout-error]')?.remove();
                    form.querySelector('input[name="email"]')?.focus();
                    return;
                }

                seconds -= 1;
                window.setTimeout(tick, 1000);
            };

            controls.forEach((control) => control.disabled = true);
            tick();
        })();
    </script>
</body>
</html>
