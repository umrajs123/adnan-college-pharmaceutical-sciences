<link rel="stylesheet" href="{{ asset('css/assistant.css') }}?v={{ filemtime(public_path('css/assistant.css')) }}">
<div class="college-assistant" data-assistant data-endpoint="{{ route('assistant.chat') }}" data-token="{{ csrf_token() }}" data-ready="{{ config('assistant.api_key') ? '1' : '0' }}">
    <button class="college-assistant__launcher" type="button" aria-controls="collegeAssistantPanel" aria-expanded="false">
        <span class="college-assistant__mark" aria-hidden="true">
            <svg viewBox="0 0 32 32" width="27" height="27" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 7.5h16a4 4 0 0 1 4 4v9a4 4 0 0 1-4 4H12l-6 4v-4H5a3 3 0 0 1-3-3v-11a3 3 0 0 1 3-3Z"/>
                <path d="m7 14 7-3 7 3-7 3-7-3Zm3 1.5v4c2.6 1.8 5.4 1.8 8 0v-4M21 14v5"/>
                <path d="m26 2 1.1 3.4L30.5 6.5l-3.4 1.1L26 11l-1.1-3.4-3.4-1.1 3.4-1.1L26 2Z" fill="currentColor" stroke="none"/>
            </svg>
        </span>
        <span>Ask the college</span><small>AI</small>
    </button>
    <section id="collegeAssistantPanel" class="college-assistant__panel" aria-label="College AI assistant" hidden>
        <header class="college-assistant__header"><div><strong data-title>College assistant</strong><span data-subtitle>AI guidance · Review important details</span></div><button type="button" data-close aria-label="Close assistant">&times;</button></header>
        <div class="college-assistant__tools"><label for="assistantLanguage" data-language-label>Language</label><select id="assistantLanguage"><option value="en">English</option><option value="ur">اردو</option></select><button type="button" data-clear>Clear chat</button></div>
        <p class="college-assistant__privacy" data-privacy>This chatbot is an AI based chatbot. Avoid sharing passwords, identity numbers or payment details.</p>
        <div class="college-assistant__messages" role="log" aria-live="polite" aria-relevant="additions" tabindex="0"></div>
        <div class="college-assistant__starters" aria-label="Suggested questions"><button type="button" data-starter="programs">Explore programs</button><button type="button" data-starter="apply">Help me apply</button><button type="button" data-starter="contact">Contact the college</button></div>
        <div class="college-assistant__draft" hidden><strong data-draft-label>Suggested application details</strong><dl></dl><button type="button" data-copy>Fill empty form fields</button><a href="{{ route('admissions.create') }}" data-apply>Open admission form</a><p data-draft-note>Review all details before submitting. Existing form entries will be kept.</p></div>
        <p class="college-assistant__status" role="status"></p>
        <form class="college-assistant__composer"><label for="assistantMessage" class="college-assistant__sr" data-message-label>Your question</label><textarea id="assistantMessage" rows="1" maxlength="2000" required placeholder="Ask about programs or get help applying..."></textarea><button type="submit" data-send>Send</button></form>
    </section>
</div>
<script src="{{ asset('js/assistant.js') }}?v={{ filemtime(public_path('js/assistant.js')) }}" defer></script>
