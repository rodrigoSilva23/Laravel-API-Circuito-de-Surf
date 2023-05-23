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

    public function testGetSingleWave()
    {
        $wave =  Waves::factory(2)->Create()->first();

        $response = $this->get('/api/waves/' . $wave->id);
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function testPostWaveEndpoint()
    {
        $battery = Battery::factory(1)->Create()->first();

        $data = [
            'fk_battery' => $battery->id,
            'fk_surfer' => $battery->fk_surfer1,
        ];
        $response = $this->post('/api/waves', $data);

        $response->assertStatus(201);

        $response->assertJson([
            'isCreatedSuccessful' => true,
            'message' => 'created successful'
        ]);
        $response = $this->postJson('/api/waves', []);
        $response->assertJsonValidationErrors(['fk_battery', 'fk_surfer']);
    }
    public function testDeletedWave()
    {
        $Wave = Waves::factory(1)->create()->first();
        $response = $this->delete('/api/waves/' . $Wave->id);


        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'wave deleted successfully',
            'isDeletedSuccessful' => true,
        ]);

        $response = $this->delete('/api/waves/10');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'wave not found',
            'isDeletedSuccessful' => false,
        ]);
    }
}
