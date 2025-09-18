<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('group')->nullable();
                $table->string('name');
                $table->longText('payload')->nullable();
                $table->boolean('locked')->default(false);
                $table->timestamps();
                $table->unique(['group', 'name']);
                $table->index('name');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
