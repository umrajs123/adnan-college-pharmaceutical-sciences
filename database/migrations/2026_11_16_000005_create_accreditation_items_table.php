<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('accreditation_items', function (Blueprint $table) { $table->id(); $table->string('name', 180); $table->text('description'); $table->string('logo_path')->nullable(); $table->string('icon_path')->nullable(); $table->unsignedInteger('sort_order')->default(0); $table->boolean('is_active')->default(true); $table->timestamps(); });
        $section = DB::table('nursing_page_sections')->where('section_type','accreditation')->first();
        if ($section) foreach (preg_split("/\r\n|\n|\r/", trim($section->body)) as $index => $item) { [$name,$description] = array_pad(explode('::', $item, 2), 2, ''); if ($name) DB::table('accreditation_items')->insert(['name' => trim($name), 'description' => trim($description), 'logo_path' => str_contains(strtolower($name),'pnmc') ? 'images/logo-pnmc.png' : (str_contains(strtolower($name),'khyber') ? 'images/logo-kmu.png' : 'images/logo-hera.webp'), 'sort_order' => $index, 'created_at' => now(), 'updated_at' => now()]); }
    }
    public function down(): void { Schema::dropIfExists('accreditation_items'); }
};
