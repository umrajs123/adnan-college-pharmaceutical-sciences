<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nursing_page_sections', function (Blueprint $table) {
            $table->json('icon_labels')->nullable()->after('icon_label');
        });
    }

    public function down(): void
    {
        Schema::table('nursing_page_sections', function (Blueprint $table) {
            $table->dropColumn('icon_labels');
        });
    }
};
