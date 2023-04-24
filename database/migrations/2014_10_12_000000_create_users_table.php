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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('birth_date');
            $table->string('birth_place', 100);
            $table->string('birth_country', 100);
            $table->string('jmbg', 13);
            $table->string('home_address', 100)->nullable();
            $table->string('home_place', 100)->nullable();
            $table->string('home_country', 100)->nullable();
            $table->string('phone', 15)->nullable();
            $table->smallInteger('seniority')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('team_lead_id')->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->tinyInteger('active')->default(0);
            $table->rememberToken();
            $table->datetimes();
            $table->softDeletesDatetime();

            $table->foreign('team_lead_id')
                ->references('id')->on('users');
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
