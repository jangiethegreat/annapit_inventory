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
        Schema::create('rejected_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('requestor_name');
            $table->string('unit_no');
            $table->string('items_requested');
            $table->string('quantity');
            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejected_tickets');
    }
};
