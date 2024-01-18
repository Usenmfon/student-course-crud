<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

     public function test_create_course()
     {
        $course = [ 'name' => 'Biology', 'code' => 'BIO400' ];

        Course::create($course);

        $this->assertDatabaseHas('courses', $course);
     }

     public function test_find_course_or_return_404()
     {
        $response = $this->get('/api/courses/1');
        $response->assertStatus(404);
     }


}
