(() => {
    const root = document.querySelector('[data-assistant]');
    if (!root) return;
    const find = (selector) => root.querySelector(selector);
    const panel = find('.college-assistant__panel');
    const launcher = find('.college-assistant__launcher');
    const language = find('#assistantLanguage');
    const messages = find('.college-assistant__messages');
    const input = find('#assistantMessage');
    const status = find('.college-assistant__status');
    const draftBox = find('.college-assistant__draft');
    const admissionForm = document.querySelector('form.application-card');
    let history = [], draft = {}, busy = false;
    const translations = {
        en: {title: 'College assistant', subtitle: 'AI guidance · Review important details', language: 'Language', clear: 'Clear chat', privacy: 'This chatbot is an AI based chatbot. Avoid sharing passwords, identity numbers or payment details.', welcome: 'Hello! Ask about the college and programs, or tell me you need help completing your admission form.', unavailable: 'The AI assistant is not connected yet. You can still complete the admission form directly.', placeholder: 'Ask about programs or get help applying...', send: 'Send', thinking: 'Thinking…', error: 'Unable to get a reply. Please try again or contact the college.', limit: 'Too many requests. Please try again later.', expired: 'Your session expired. Refresh the page and try again.', draft: 'Suggested application details', copy: 'Fill empty form fields', apply: 'Open admission form', note: 'Review all details before submitting. Existing form entries will be kept.', copied: 'Empty fields filled. Review the form, confirm your details and submit it yourself.', kept: 'Your existing entries were kept. Review the suggestions above.', question: 'Your question', close: 'Close assistant', full_name: 'Full name', email: 'Email', phone: 'Phone', qualification: 'Latest qualification', program: 'Program'},
        ur: {title: 'کالج معاون', subtitle: 'اے آئی رہنمائی · اہم معلومات کی تصدیق کریں', language: 'زبان', clear: 'چیٹ صاف کریں', privacy: 'جوابات کے لیے پیغامات Groq کو بھیجے جاتے ہیں۔ پاس ورڈ، شناختی نمبر یا ادائیگی کی معلومات شیئر نہ کریں۔', welcome: 'السلام علیکم! کالج اور پروگراموں کے بارے میں پوچھیں یا داخلہ فارم مکمل کرنے میں مدد حاصل کریں۔', unavailable: 'اے آئی معاون ابھی منسلک نہیں ہے۔ آپ داخلہ فارم خود مکمل کر سکتے ہیں۔', placeholder: 'اپنا سوال یہاں لکھیں۔۔۔', send: 'بھیجیں', thinking: 'جواب تیار ہو رہا ہے۔۔۔', error: 'جواب حاصل نہیں ہو سکا۔ دوبارہ کوشش کریں یا کالج سے رابطہ کریں۔', limit: 'درخواستوں کی حد پوری ہو گئی ہے۔ کچھ دیر بعد کوشش کریں۔', expired: 'سیشن ختم ہو گیا ہے۔ صفحہ ریفریش کریں۔', draft: 'درخواست کی مجوزہ تفصیلات', copy: 'فارم کے خالی خانے بھریں', apply: 'داخلہ فارم کھولیں', note: 'جمع کرانے سے پہلے تمام تفصیلات دیکھ لیں۔ پہلے سے درج معلومات تبدیل نہیں ہوں گی۔', copied: 'خالی خانے بھر دیے گئے ہیں۔ فارم دیکھیں، تصدیق کریں اور خود جمع کرائیں۔', kept: 'پہلے سے درج معلومات برقرار ہیں۔ اوپر دی گئی تجاویز دیکھیں۔', question: 'آپ کا سوال', close: 'معاون بند کریں', full_name: 'پورا نام', email: 'ای میل', phone: 'فون', qualification: 'آخری تعلیمی قابلیت', program: 'پروگرام'}
    };
    const t = () => translations[language.value];
    const starters = {
        en: {programs: ['Explore programs', 'Which programs can I apply for?'], apply: ['Help me apply', 'Help me fill my application, one step at a time.'], contact: ['Contact the college', 'How can I contact the college?']},
        ur: {programs: ['پروگرام دیکھیں', 'میں کن پروگراموں میں داخلہ لے سکتا ہوں؟'], apply: ['درخواست میں مدد', 'داخلہ فارم بھرنے میں ایک ایک قدم پر میری مدد کریں۔'], contact: ['کالج سے رابطہ', 'میں کالج سے کیسے رابطہ کروں؟']}
    };
    translations.en.welcome = 'Hi! How can I help? Ask about a program or let’s start your application.';
    translations.en.subtitle = 'Your guide to college life';
    translations.en.placeholder = 'What would you like to know?';
    translations.ur.welcome = 'السلام علیکم! پروگراموں کے بارے میں پوچھیں یا داخلہ فارم میں مدد حاصل کریں۔';
    translations.ur.subtitle = 'کالج کے سفر میں آپ کا رہنما';
    const starterButtons = Array.from(root.querySelectorAll('[data-starter]'));
    const composer = find('.college-assistant__composer');
    function resizeInput() {
        input.style.height = 'auto';
        input.style.height = `${Math.min(112, Math.max(44, input.scrollHeight + 2))}px`;
    }
    input.addEventListener('input', resizeInput);
    function setBusy(value) {
        busy = value;
        panel.classList.toggle('is-busy', value);
        messages.setAttribute('aria-busy', String(value));
        [find('[data-send]'), find('[data-clear]'), language, ...starterButtons].forEach(el => {el.disabled = value || root.dataset.ready !== '1';});
    }
    function bubble(text, role, sources = []) {
        const item = document.createElement('div');
        item.className = `college-assistant__bubble college-assistant__bubble--${role}`;
        item.dir = 'auto';
        item.textContent = text;
        sources.forEach((source) => {
            const url = new URL(source.url, location.origin);
            if (url.origin !== location.origin || !['http:', 'https:'].includes(url.protocol)) return;
            const link = document.createElement('a');
            link.href = url.href;
            link.textContent = source.title;
            item.append(link);
        });
        messages.append(item);
        messages.scrollTop = messages.scrollHeight;
    }
    function renderDraft() {
        draftBox.hidden = !Object.keys(draft).length;
        const list = find('.college-assistant__draft dl');
        list.replaceChildren();
        Object.entries(draft).forEach(([key, value]) => {
            if (!['full_name', 'email', 'phone', 'qualification', 'program'].includes(key) || typeof value !== 'string') return;
            const label = document.createElement('dt'), detail = document.createElement('dd');
            label.textContent = t()[key]; detail.textContent = value; detail.dir = 'auto';
            list.append(label, detail);
        });
        find('[data-copy]').hidden = !admissionForm;
        find('[data-apply]').hidden = !!admissionForm;
    }
    function localize() {
        panel.dir = language.value === 'ur' ? 'rtl' : 'ltr';
        panel.lang = language.value;
        const labels = {'[data-title]': 'title', '[data-subtitle]': 'subtitle', '[data-language-label]': 'language', '[data-clear]': 'clear', '[data-privacy]': 'privacy', '[data-send]': 'send', '[data-draft-label]': 'draft', '[data-copy]': 'copy', '[data-apply]': 'apply', '[data-draft-note]': 'note', '[data-message-label]': 'question'};
        Object.entries(labels).forEach(([selector, key]) => {find(selector).textContent = t()[key];});
        find('[data-close]').setAttribute('aria-label', t().close);
        input.placeholder = t().placeholder;
        status.textContent = '';
        if (!history.length) {
            messages.replaceChildren();
            bubble(root.dataset.ready === '1' ? t().welcome : t().unavailable, 'assistant');
        }
        input.disabled = root.dataset.ready !== '1';
        find('[data-send]').disabled = input.disabled;
        renderDraft();
        starterButtons.forEach(button => {
            button.textContent = starters[language.value][button.dataset.starter][0];
            button.disabled = root.dataset.ready !== '1';
        });
        find('.college-assistant__starters').hidden = history.length > 0;
    }
    function close() { panel.hidden = true; launcher.setAttribute('aria-expanded', 'false'); launcher.focus(); }
    launcher.addEventListener('click', () => {
        panel.hidden = !panel.hidden;
        launcher.setAttribute('aria-expanded', String(!panel.hidden));
        if (!panel.hidden) (input.disabled ? language : input).focus();
    });
    find('[data-close]').addEventListener('click', close);
    panel.addEventListener('keydown', (event) => {if (event.key === 'Escape') close();});
    language.addEventListener('change', localize);
    find('[data-clear]').addEventListener('click', () => {if (!busy) {history = []; draft = {}; input.value = ''; localize();}});
    find('[data-copy]').addEventListener('click', () => {
        if (!admissionForm) return;
        let count = 0;
        Object.entries(draft).forEach(([name, value]) => {
            if (!['full_name', 'email', 'phone', 'qualification', 'program'].includes(name)) return;
            const field = admissionForm.elements.namedItem(name);
            if (!field || field.value.trim()) return;
            if (field.tagName === 'SELECT' && !Array.from(field.options).some(option => option.value === value)) return;
            field.value = value;
            field.dispatchEvent(new Event('input', {bubbles: true}));
            count++;
        });
        status.textContent = count ? t().copied : t().kept;
    });
    starterButtons.forEach(button => button.addEventListener('click', () => {
        if (busy) return;
        input.value = starters[language.value][button.dataset.starter][1];
        composer.requestSubmit();
    }));
    input.addEventListener('keydown', event => {
        if (event.key === 'Enter' && !event.shiftKey && !event.isComposing && !busy) {
            event.preventDefault(); composer.requestSubmit();
        }
    });
    composer.addEventListener('submit', async (event) => {
        event.preventDefault();
        const content = input.value.trim();
        if (busy || !content || root.dataset.ready !== '1') return;
        setBusy(true);
        find('.college-assistant__starters').hidden = true;
        const userMessage = {role: 'user', content};
        const requestMessages = [...history.slice(-10), userMessage];
        bubble(content, 'user'); input.value = ''; resizeInput(); status.textContent = t().thinking;
        const controller = new AbortController();
        const timer = setTimeout(() => controller.abort(), 50000);
        try {
            const response = await fetch(root.dataset.endpoint, {method: 'POST', credentials: 'same-origin', signal: controller.signal, headers: {'Content-Type': 'application/json', Accept: 'application/json', 'X-CSRF-TOKEN': root.dataset.token}, body: JSON.stringify({language: language.value, messages: requestMessages})});
            const data = await response.json().catch(() => ({}));
            if (!response.ok) throw new Error(response.status === 429 ? t().limit : response.status === 419 ? t().expired : response.status === 503 ? data.message || t().error : t().error);
            if (typeof data.reply !== 'string') throw new Error(t().error);
            bubble(data.reply, 'assistant', data.sources || []);
            history = [...requestMessages, {role: 'assistant', content: data.reply.slice(0, 2000)}].slice(-10);
            draft = data.draft || {}; renderDraft(); status.textContent = '';
        } catch (error) {
            status.textContent = error.name === 'AbortError' ? t().error : error.message;
            input.value = content;
            resizeInput();
        } finally {
            clearTimeout(timer); setBusy(false);
        }
    });
    localize();
})();
