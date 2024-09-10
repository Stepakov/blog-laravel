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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string( 'title' );
            $table->string( 'slug' )->unique();
            $table->text( 'content' )->nullable();
            $table->string( 'thumbnail' )->nullable();
            $table->string( 'image' )->nullable();
            $table->foreignIdFor( \App\Models\User::class )
                ->constrained()
                ->nullable();
            $table->foreignIdFor( \App\Models\Category::class )
                ->constrained()
                ->nullable();
            $table->boolean( 'is_published' )->default( true );
            $table->unsignedTinyInteger( 'status' )->default( 1 );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
