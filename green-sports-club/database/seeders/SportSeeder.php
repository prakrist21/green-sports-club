<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sport;

class SportSeeder extends Seeder
{
    public function run(): void
    {
        $sports = [
            ['name' => 'Gym', 'description' => 'Fitness and strength training'],
            ['name' => 'Swimming', 'description' => 'Pool swimming and water sports'],
            ['name' => 'Futsal', 'description' => 'Indoor football / futsal'],
            ['name' => 'Cricket', 'description' => 'Cricket training and matches'],
            ['name' => 'Basketball', 'description' => 'Basketball training and games'],
        ];

        foreach ($sports as $sport) {
            Sport::create($sport);
        }
    }
}