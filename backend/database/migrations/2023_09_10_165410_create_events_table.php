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
        Schema::create('events', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->comment(__('event.user_id'))->constrained();
            $table->string('title')->comment(__('event.title'));
            $table->text('description')->comment(__('event.description'));
            $table->string('location')->comment(__('event.location'));
            $table->date('event_date')->comment(__('event.event_date'));
            $table->time('event_time')->comment(__('event.event_time'));
            $table->timestamps();

            $table->comment(__('event.table_description'));
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
