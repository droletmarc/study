<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'John',
            'email' => 'test@test.com'
        ]);

        // model need to define use HasFactory, Notifiable;
        Listing::factory(10)->create([
            'user_id' => $user->id
        ]);

    //     Listing::create([
    //         // data here
    //     ]);
    }
}
