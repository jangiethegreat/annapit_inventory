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
        Schema::create('deployeds', function (Blueprint $table) {
            $table->id();
            $table->string('requested_by');
            $table->string('unit_no');
            $table->string('item_requested');
            $table->string('quantity');
            $table->string('deployed_by');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deployeds');
    }
};