<?php

declare(strict_types=1);

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
        Schema::create('participations', function (Blueprint $table) {
            $table->foreignUlid('user_id')->constrained()->comment(__('participation.user_id'));
            $table->foreignUlid('event_id')->constrained()->comment(__('participation.event_id'));
            $table->boolean('status')->default(false)->comment(__('participation.status'));
            $table->timestamps();

            $table->primary(['user_id', 'event_id']);
            $table->comment(__('table_description'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
