<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! DB::table('nursing_page_sections')->where('section_type', 'accreditation')->exists()) {
            DB::table('nursing_page_sections')->insert([
                'section_type' => 'accreditation',
                'eyebrow' => 'Accreditation & Recognition',
                'title' => 'Choose a nursing education pathway with confidence.',
                'body' => implode("\n", [
                    'Pakistan Nursing & Midwifery Council (PNMC)::PNMC recognition is the national regulatory checkpoint for nursing education and professional qualifications.',
                    'Khyber Medical University (KMU)::Official KMU and provincial listings show nursing institutions in Swat working through university affiliation pathways.',
                    'KP HERA registration::The provincial regulator lists active allied-health institutions in Swat with program and affiliation details for families to verify.',
                ]),
                'icon_label' => 'shield',
                'sort_order' => 35,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('nursing_page_sections')->where('section_type', 'accreditation')->delete();
    }
};
