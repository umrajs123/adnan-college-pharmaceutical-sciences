<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## College AI assistant

The public footer includes an English/Urdu assistant. The admission form stays in English. It uses active college/program/about content, shows supporting page links, and suggests application fields for users to review. It cannot submit applications, retrieve private records or check application status. On `/apply`, **Fill empty form fields** copies suggestions without overwriting existing entries or checking the confirmation box.

To enable replies, set these server-only values in `.env` (never commit the key):

```dotenv
GROQ_API_KEY=your-api-key
GROQ_MODEL=openai/gpt-oss-20b
AI_DAILY_LIMIT=200
```

Run `php artisan config:clear` after changing configuration. Create a free Groq account and generate a key at https://console.groq.com/keys. Keep the account on the Free plan without upgrading or enabling paid billing. See [Groq billing](https://console.groq.com/docs/billing-faqs), [rate limits](https://console.groq.com/docs/rate-limits) and [structured outputs](https://console.groq.com/docs/structured-outputs). No additional PHP package is required. The model runs on Groq's servers; the Laravel website still needs its usual web hosting for public access. The `openai/` prefix in this model's name identifies its author; requests go to Groq, not the paid OpenAI API. Legacy `OPENAI_API_KEY` settings are ignored.

Without a key, the widget clearly reports that AI is not connected and the normal admission form remains available. Messages are sent to Groq; the application does not save chat history. Review [Groq data controls](https://console.groq.com/docs/your-data) and enable Zero Data Retention in the Groq account if appropriate. The browser keeps only a short conversation in memory until refresh/clear. Public content accompanies each request, but saved applications and user accounts are never included. Review college content before enabling replies: missing fees, deadlines and policies cannot be answered reliably. The assistant is instructed to refer unknown questions to staff.

The endpoint uses CSRF protection, eight requests per minute per IP, and a shared daily limit (default 200) backed by Laravel's configured cache. Groq also applies token and request limits, which may be reached sooner. When quota is exhausted, replies pause; there is no paid fallback. Free-tier availability and limits can change. Run `php artisan test --filter=CollegeAssistantTest` for mocked provider, validation, privacy, error and rate-limit checks. A live English/Urdu reply requires a configured Groq key and must be verified separately.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
