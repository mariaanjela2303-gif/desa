<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('village_name')->default('Desa Tautpah');
            $table->string('district')->default('Biboki Selatan');
            $table->string('regency')->default('Timor Tengah Utara');
            $table->string('province')->default('Nusa Tenggara Timur');
            $table->text('about')->nullable();
            $table->longText('history')->nullable();
            $table->text('vision')->nullable();
            $table->longText('mission')->nullable();
            $table->string('leader_name')->nullable();
            $table->text('welcome_message')->nullable();
            $table->string('leader_photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_profiles');
    }
};
