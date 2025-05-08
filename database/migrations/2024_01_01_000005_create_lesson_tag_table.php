<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lesson_tag', function (Blueprint $table) {
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // Thêm cả created_at và updated_at
            $table->primary(['lesson_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_tag');
    }
};