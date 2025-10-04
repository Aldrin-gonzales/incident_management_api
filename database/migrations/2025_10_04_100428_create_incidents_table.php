<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->enum('status', ['reported', 'in_progress', 'resolved', 'closed'])->default('reported');
            $table->foreignId('incident_type_id')->constrained('incident_types');
            $table->foreignId('reported_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidents');
    }
};
