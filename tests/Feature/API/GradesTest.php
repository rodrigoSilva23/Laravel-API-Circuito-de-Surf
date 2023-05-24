<?php

namespace Tests\Feature\API;

use App\Models\Grades;
use App\Models\surfer;
use App\Models\Waves;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GradesTest extends TestCase
{
    use RefreshDatabase;
    public function testAllGradesEndpoint(): void
    {
        Grades::factory(2)->Create();

        $response = $this->get('/api/grades');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    public function testSingleGradesEndpoint(): void
    {
        $grande = Grades::factory(1)->Create()->first();

        $response = $this->get('/api/grades/' . $grande->id);
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function testPostGradesEndpoint(): void
    {

        $waves = Waves::factory(2)->Create()->first();
        $data = [
            'fk_wave' => $waves->id,
            'partial_grades1' => fake()->numberBetween(1, 10),
            'partial_grades2' => fake()->numberBetween(1, 10),
            'partial_grades3' => fake()->numberBetween(1, 10)
        ];

        $response = $this->post('/api/grades/', $data);
        $response->assertStatus(201);

        $response->assertJson([
            'isCreatedSuccessful' => true,
            'message' => 'created successful'
        ]);
        $response = $this->postJson('/api/grades', []);
        $response->assertJsonValidationErrors([
            'fk_wave',
            'partial_grades1',
            'partial_grades2',
            'partial_grades3'
        ]);
    }
    public function testDeletedWave()
    {
        $grades = Grades::factory(1)->create()->first();
        $response = $this->delete('/api/grades/' . $grades->id);


        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'grades deleted successfully',
            'isDeletedSuccessful' => true,
        ]);

        $response = $this->delete('/api/grades/10');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'grades not found',
            'isDeletedSuccessful' => false,
        ]);
    }
}
