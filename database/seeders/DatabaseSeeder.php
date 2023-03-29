<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // \App\Models\Menu::factory(10)->create();
        \App\Models\Category::factory(3)->create();

        \App\Models\Menu::factory(10)->create([
            'category_id' => 1,

        ]);

        \App\Models\Addon::factory(3)->create();

        \App\Models\Foodaddon::factory(3)->create([
            'addon_id' => 1,
            'menu_id' => 1
        ]);

        \App\Models\Addondetail::factory(20)->create([
            'addon_id' => 1,
        ]);

        \App\Models\Order::factory(3)->create();

        \App\Models\Orderdetail::factory(10)->create([
            'order_id' => 1,
            'menu_id' => 1
        ]);
    }
}
