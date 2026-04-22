<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Coach;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@greensports.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Coach
        $coachUser = User::create([
            'name' => 'John Coach',
            'email' => 'coach@greensports.com',
            'password' => Hash::make('password'),
            'role' => 'coach',
        ]);

        Coach::create([
            'user_id' => $coachUser->id,
            'bio' => 'Experienced sports coach with 10 years of experience.',
            'specialization' => 'Futsal',
            'phone' => '9800000001',
        ]);

        // Student
        $studentUser = User::create([
            'name' => 'Jane Student',
            'email' => 'student@greensports.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $studentUser->id,
            'dob' => '2000-01-01',
            'phone' => '9800000002',
            'address' => 'Kathmandu, Nepal',
            'enrolled_at' => now(),
        ]);
    }
}