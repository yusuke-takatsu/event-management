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
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment(__('users.id'));
            $table->string('name')->comment(__('users.name'));
            $table->string('email')->unique()->comment(__('users.email'));
            $table->timestamp('email_verified_at')->nullable()->comment(__('users.email_verified_at'));
            $table->string('password')->comment(__('users.password'));
            $table->rememberToken()->comment(__('users.remember_token'));
            $table->timestamps();

            $table->comment(__('users.table_description'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
