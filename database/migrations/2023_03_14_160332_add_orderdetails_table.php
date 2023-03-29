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

        Schema::table('orderdetails', function (Blueprint $table) {

            $table->unsignedInteger('orderdetails_quantity');
            $table->unsignedInteger('orderdetails_totalprice');
            // $table->longText('orderid');
            // $table->unsignedInteger('foodid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orderdetails', [
            'orderdetails_quantity', 'orderdetails_totalprice'

        ]);
    }
};
