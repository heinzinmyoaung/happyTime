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
        //
        Schema::table('orderdetails', function (Blueprint $table) {
            //
            $table->foreignIdFor(
                \App\Models\Order::class,
                'order_id'
            )->constrained('orders');

            $table->foreignIdFor(
                \App\Models\Menu::class,
                'menu_id'
            )->constrained('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
