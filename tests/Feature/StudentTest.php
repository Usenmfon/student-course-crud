<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_create_student()
    {
        $response = $this->get('/api/students');

        Student::factory()->count(3)->create();

        $this->assertDatabaseCount('students', 3);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);
    }

}
