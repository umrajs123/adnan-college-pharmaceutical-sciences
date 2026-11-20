<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();
            $table->string('full_name', 150);
            $table->string('email');
            $table->string('phone', 30);
            $table->string('program');
            $table->string('qualification', 200);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('admission_applications'); }
};
