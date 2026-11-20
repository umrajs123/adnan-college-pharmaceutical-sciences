<?php

namespace App\Http\Controllers;

use App\Services\CollegeAssistant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Client\ConnectionException;
use RuntimeException;

class CollegeAssistantController extends Controller
{
    public function __invoke(Request $request, CollegeAssistant $assistant)
    {
        $data = $request->validate([
            'language' => ['required', Rule::in(['en', 'ur'])],
            'messages' => ['required', 'array', 'min:1', 'max:12'],
            'messages.*' => ['required', 'array:role,content'],
            'messages.*.role' => ['required', Rule::in(['user', 'assistant'])],
            'messages.*.content' => ['required', 'string', 'max:2000'],
        ]);
        abort_unless(end($data['messages'])['role'] === 'user', 422);
        $unavailable = $data['language'] === 'ur' ? 'معذرت، اس وقت معاون دستیاب نہیں ہے۔ براہ کرم کالج سے رابطہ کریں یا داخلہ فارم خود مکمل کریں۔' : 'The assistant is currently unavailable. Please contact the college or complete the admission form directly.';
        if (! config('assistant.api_key')) {
            return response()->json(['message' => $unavailable], 503)->header('Cache-Control', 'no-store');
        }
        try {
            return response()->json($assistant->reply($data['messages'], $data['language']))->header('Cache-Control', 'no-store');
        } catch (\App\Exceptions\AssistantQuotaExceeded $e) {
            return response()->json(['message' => $data['language'] === 'ur'
                ? 'معاون کی مفت استعمال کی حد پوری ہو گئی ہے۔ کچھ دیر بعد کوشش کریں یا داخلہ فارم خود مکمل کریں۔'
                : 'The assistant has reached its free usage limit. Please try again later or complete the admission form directly.'], 429)->header('Cache-Control', 'no-store');
        } catch (ConnectionException|RuntimeException $e) {
            return response()->json(['message' => $unavailable], 503)->header('Cache-Control', 'no-store');
        }
    }
}
