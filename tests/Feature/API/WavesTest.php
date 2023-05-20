<?php

namespace Tests\Feature\API;

use App\Models\Battery;
use App\Models\Waves;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WavesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllWave(): void
    {


        Waves::factory(2)->Create();

        $response = $this->get('/api/waves');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    // public function testGetSingleWave()
    // {
    //     $Wave =  Waves::factory(2)->Create()->first();

    //     $response = $this->get('/api/Waves/' . $Wave->id);

    //     $response->assertStatus(200);
    //     $response->assertJsonCount(1);
    // }

    // public function testPostWave()
    // {
    //     $surfers = 1; // surfer::factory(2)->create();
    //     $data = [
    //         'fk_surfer1' => $surfers[0]->id,
    //         'fk_surfer2' => $surfers[1]->id,
    //     ];
    //     $response = $this->post('/api/Waves', $data);

    //     $response->assertStatus(201);
    //     $response->assertJsonStructure([
    //         'id',
    //         'isSuccessful',
    //     ]);
    //     $response->assertJson([
    //         'id' => 1,
    //         'isSuccessful' => true,
    //     ]);
    //     $response = $this->postJson('/api/Waves', []);
    //     $response->assertJsonValidationErrors(['fk_surfer1', 'fk_surfer2']);
    // }

    // public function testDeletedWave()
    // {
    //     $Wave = Waves::factory(1)->create()->first();
    //     $response = $this->delete('/api/Waves/' . $Wave->id);


    //     $response->assertStatus(200);
    //     $response->assertJson([
    //         'message' => 'Wave deleted successfully',
    //         'isDeletedSuccessful' => true,
    //     ]);

    //     $response = $this->delete('/api/Waves/10');

    //     $response->assertStatus(404);
    //     $response->assertJson([
    //         'message' => 'Wave not found',
    //         'isDeletedSuccessful' => false,
    //     ]);
    // }
}
