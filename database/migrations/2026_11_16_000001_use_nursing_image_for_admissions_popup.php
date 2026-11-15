<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('site_settings')->update([
            'admissions_popup_image_path' => 'images/nursing-care.jpg',
        ]);
    }

    public function down(): void
    {
        // Preserve the chosen image: the previous admin-managed value is unknown.
    }
};
