<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.org',
            ],
            [
                'first_name' => 'Martha',
                'last_name' => 'Giggs',
                'email' => 'marthagiggs@example.org',
            ],
            [
                'first_name' => 'Erland',
                'last_name' => 'Doe',
                'email' => 'erlanddoe@example.org',
            ],
            [
                'first_name' => 'Kingsley',
                'last_name' => 'Greek',
                'email' => 'kingsleygreek@example.org',
            ],
            [
                'first_name' => 'Yu',
                'last_name' => 'Sho',
                'email' => 'yusho@example.org',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
