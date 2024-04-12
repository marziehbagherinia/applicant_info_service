<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create( 'forms', function ( Blueprint $table )
        {
            $table->id();
            $table->string( 'user_name' )->nullable();
            $table->unsignedBigInteger( 'operator_id' )->nullable();
            $table->integer( 'age' )->nullable();
            $table->string( 'gender' )->nullable();
            $table->string( 'job' )->nullable();
            $table->string( 'preferred_learning_format' )->nullable();
            $table->string( 'learning_goal' )->nullable();
            $table->string( 'education_degree' )->nullable();
            $table->string( 'education_major' )->nullable();
            $table->boolean( 'migration_preference' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( 'forms' );
    }
};
