<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nursery_workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('telephone')->unique();
            $table->string('login')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_role');
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('id_role')->references('id')->on('nursery_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nursery_workers');
    }
};
