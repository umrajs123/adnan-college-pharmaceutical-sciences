@if($settings->admissions_popup_is_active)
    @php
        $popupButtonUrl = $settings->admissions_popup_button_url
            ?: ($admissionsUrl ?? $settings->admissions_url ?: 'https://scps.digitalcampuspro.com/admin/login');
        $popupImageUrl = $settings->admissionsPopupImageUrl();
    @endphp

    <dialog class="acps-invitation" data-admissions-popup aria-labelledby="admissionsPopupHeading" aria-describedby="admissionsPopupBody">
        <div class="acps-invitation__sheet">
            <header class="acps-invitation__header">
                <div class="acps-invitation__brand">
                    <img src="{{ $settings->logoUrl() }}" alt="{{ $settings->site_name }} logo" width="48" height="48">
                    <div>
                        <strong>{{ $settings->site_name }}</strong>
                        <small>{{ $settings->site_tagline }}</small>
                    </div>
                </div>
                <button class="acps-invitation__close" type="button" data-admissions-popup-close aria-label="Close admissions announcement" autofocus>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18"/></svg>
                </button>
            </header>

            <div class="acps-invitation__intro">
                <div class="acps-invitation__copy">
                    <div class="acps-invitation__status">
                        <span>{{ $settings->admissions_popup_eyebrow ?: 'Admissions Open' }}</span>
                        @if($settings->admissions_popup_session)
                            <strong>{{ $settings->admissions_popup_session }}</strong>
                        @endif
                    </div>
                    <h2 id="admissionsPopupHeading">{{ $settings->admissions_popup_heading }}</h2>
                    <p id="admissionsPopupBody">{{ $settings->admissions_popup_body }}</p>
                    <div class="acps-invitation__actions">
                        <a class="acps-invitation__apply" href="{{ $popupButtonUrl }}">
                            {{ $settings->admissions_popup_button_label }}
                            <span aria-hidden="true">&nearr;</span>
                        </a>
                        <button class="acps-invitation__later" type="button" data-admissions-popup-close>Maybe later</button>
                    </div>
                </div>
                <aside class="acps-invitation__visual">
                    @if($popupImageUrl)
                        <img src="{{ $popupImageUrl }}" alt="" class="acps-invitation__image">
                    @endif
                    <div class="acps-invitation__visual-copy">
                        <span class="acps-invitation__seal" aria-hidden="true">Rx</span>
                        <strong>A future<br> in healthcare.</strong>
                        <small>Knowledge that makes a difference</small>
                    </div>
                </aside>
            </div>

            @if(($admissionsPopupPrograms ?? collect())->isNotEmpty())
                <section class="acps-invitation__programs" aria-labelledby="admissionsPopupProgramsHeading">
                    <h3 id="admissionsPopupProgramsHeading">Programs open for admission</h3>
                    <div class="acps-invitation__program-list">
                        @foreach($admissionsPopupPrograms as $program)
                            <a class="acps-invitation__program" href="{{ $program->publicUrl() }}">
                                <span class="acps-invitation__program-icon">{{ $program->icon_label ?: 'Rx' }}</span>
                                <strong>{{ $program->title }}</strong>
                                <span class="acps-invitation__arrow" aria-hidden="true">&nearr;</span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </dialog>

    <script>
        (() => {
            const popup = document.querySelector('[data-admissions-popup]');
            if (!popup || window.location.hash) return;

            const previouslyFocused = document.activeElement;
            const dismiss = () => popup.close();
            popup.addEventListener('close', () => {
                document.documentElement.classList.remove('acps-invitation-open');
                previouslyFocused?.focus?.({ preventScroll: true });
            });
            popup.querySelectorAll('[data-admissions-popup-close]').forEach(button => {
                button.addEventListener('click', dismiss);
            });
            // The native dialog keeps background content inert and supports Escape.
            popup.addEventListener('click', event => {
                if (event.target === popup) dismiss();
            });
            popup.querySelectorAll('a[href]').forEach(link => {
                link.addEventListener('click', () => {
                    const destination = new URL(link.href, window.location.href);
                    if (destination.origin === location.origin && destination.pathname === location.pathname && destination.hash) dismiss();
                });
            });
            popup.addEventListener('keydown', event => {
                if (event.key !== 'Tab') return;
                const controls = [...popup.querySelectorAll('a[href], button:not(:disabled)')];
                const first = controls[0];
                const last = controls[controls.length - 1];
                if (event.shiftKey && document.activeElement === first) {
                    event.preventDefault();
                    last.focus();
                } else if (!event.shiftKey && document.activeElement === last) {
                    event.preventDefault();
                    first.focus();
                }
            });
            // Fit the whole card on unusually short screens without a scroll area.
            // Compact CSS handles normal phone/tablet layouts; scaling is a last resort.
            const sheet = popup.querySelector('.acps-invitation__sheet');
            const fitToViewport = () => {
                if (!popup.open) return;
                const viewport = window.visualViewport;
                const width = viewport?.width ?? window.innerWidth;
                const height = viewport?.height ?? window.innerHeight;
                const gutter = width <= 700 ? 24 : 48;
                const cardWidth = Math.min(940, width - gutter);
                sheet.style.width = `${cardWidth - 2}px`;
                sheet.style.transform = 'none';
                const cardHeight = sheet.offsetHeight;
                const scale = Math.min(1, (height - gutter - 2) / cardHeight);
                sheet.style.transformOrigin = 'top left';
                sheet.style.transform = `scale(${scale})`;
                popup.style.width = `${(cardWidth - 2) * scale + 2}px`;
                popup.style.height = `${cardHeight * scale + 2}px`;
            };
            let fitFrame;
            const scheduleFit = () => {
                cancelAnimationFrame(fitFrame);
                fitFrame = requestAnimationFrame(fitToViewport);
            };
            new ResizeObserver(scheduleFit).observe(sheet);
            window.addEventListener('resize', scheduleFit);
            window.visualViewport?.addEventListener('resize', scheduleFit);
            document.fonts?.ready.then(scheduleFit);
            popup.showModal();
            fitToViewport();
            document.documentElement.classList.add('acps-invitation-open');
        })();
    </script>
@endif
