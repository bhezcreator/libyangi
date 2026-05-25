<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('theme_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('concerne')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('type');
            $table->string('image')->nullable();
            $table->enum('status', ['brouillon', 'publié', 'fermé'])->default('brouillon');

            $table->boolean('v_address')->default(true);
            $table->boolean('v_programme')->default(true);
            $table->boolean('v_detail_event')->default(true);
            $table->boolean('v_livre')->default(true);
            $table->boolean('v_infos_invite')->default(true);
            $table->boolean('v_btn_valide')->default(true);
            $table->boolean('v_date_debut')->default(true);
            $table->boolean('v_date_fin')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
