<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Introduction To Physics',
                'code' => 'PHY101'
            ],
            [
                'name' => 'Inferential Statistics',
                'code' => 'STA302'
            ],
            [
                'name' => 'Nigerian Economy',
                'code' => 'NNN400'
            ],
        ];

        foreach($courses as $course)
        {
            Course::create($course);
        }
    }
}
