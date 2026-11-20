<?php

return [
    'api_key' => env('GROQ_API_KEY'),
    'model' => env('GROQ_MODEL', 'openai/gpt-oss-20b'),
    'daily_limit' => (int) env('AI_DAILY_LIMIT', 200),
];
