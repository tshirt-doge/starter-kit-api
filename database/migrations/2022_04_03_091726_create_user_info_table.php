<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('home_address')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->json('meta')->nullable(); // we may need to add extra things we can't predict yet
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
    }
};
