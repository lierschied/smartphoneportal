<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->createOne(['name' => 'test', 'email' => 'test@mail.de']);

        $this->call([
            SmartphoneSeeder::class,
            UserSeeder::class
        ]);

        \Artisan::call('ide-helper:generate');
        \Artisan::call('ide-helper:models -W');
        \Artisan::call('ide-helper:meta');
        \Artisan::call('ide-helper:eloquent');
    }
}
