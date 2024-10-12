<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemsMovement;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Item::create([
            'name' => 'Item 1',
            'quantity' => 100,
            'description' => 'Description for Item 1',
            'location' => 'Warehouse A',
        ]);

        Item::create([
            'name' => 'Item 2',
            'quantity' => 50,
            'description' => 'Description for Item 2',
            'location' => 'Warehouse B',
        ]);

        Item::create([
            'name' => 'Item 3',
            'quantity' => 75,
            'description' => 'Description for Item 3',
            'location' => 'Warehouse C',
        ]);

        ItemsMovement::create([
            'item_id' => 1, // Ensure this matches an existing item ID
            'quantity' => 10,
            'location' => 'Location A',
        ]);

        ItemsMovement::create([
            'item_id' => 2, // Ensure this matches an existing item ID
            'quantity' => 5,
            'location' => 'Location B',
        ]);

        ItemsMovement::create([
            'item_id' => 3, // Ensure this matches an existing item ID
            'quantity' => 15,
            'location' => 'Location C',
        ]);

       
    }
}
