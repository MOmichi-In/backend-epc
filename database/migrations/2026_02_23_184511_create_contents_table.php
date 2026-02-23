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
    Schema::create('contents', function (Blueprint $table) {
        $table->id();
        $table->string('section');          // hero, about, services, etc.
        $table->string('title');
        $table->longText('body')->nullable();
        $table->string('image_url')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('order')->default(0);
        $table->foreignId('updated_by')->nullable()->constrained('users');
        $table->timestamps();

        $table->index('section');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
