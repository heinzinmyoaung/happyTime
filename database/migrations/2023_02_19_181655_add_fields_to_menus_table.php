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
        Schema::table('menus', function (Blueprint $table) {
            //
            $table->tinyText('product_name');
            $table->tinyText('product_description');
            $table->longText('product_image');
            $table->unsignedInteger('product_price');
            // $table->unsignedInteger('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', [
            'product_name', 'product_description', 'product_image', 'product_price'

        ]);
    }
};
