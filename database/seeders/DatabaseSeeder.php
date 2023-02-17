<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        UserFactory::new()->count(10)->create();

        $this->call([
            WebsiteSeeder::class,
            PostSeeder::class,
        ]);
    }
}
