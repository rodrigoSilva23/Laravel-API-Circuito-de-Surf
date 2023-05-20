<?php

namespace Tests\Feature\API;

use App\Models\Battery;
use App\Models\surfer;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BatteryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testGetAllBattery(): void
    {

        Battery::factory(2)->Create();
        $response = $this->get('/api/batteries');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    public function testGetSingleBattery()
    {
        $battery =  Battery::factory(2)->Create()->first();

        $response = $this->get('/api/batteries/' . $battery->id);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function testPostBattery()
    {
        $surfers = surfer::factory(2)->create();
        $data = [
            'fk_surfer1' => $surfers[0]->id,
            'fk_surfer2' => $surfers[1]->id,
        ];
        $response = $this->post('/api/batteries', $data);
        
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'isSuccessful',
        ]);
        $response->assertJson([
            'id' => 1,
            'isSuccessful' => true,
        ]);
        $response = $this->postJson('/api/batteries', []);
        $response->assertJsonValidationErrors(['fk_surfer1','fk_surfer2']);
    }

    public function testDeletedBattery(){
        $battery = Battery::factory(1)->create()->first();
        $response = $this->delete('/api/batteries/'.$battery->id);


        $response->assertStatus(200);
        $response->assertJson([
            'message'=> 'battery deleted successfully',
            'isDeletedSuccessful'=> true,
        ]);

        $response = $this->delete('/api/batteries/10');

        $response->assertStatus(404);
        $response->assertJson([
            'message'=> 'battery not found',
            'isDeletedSuccessful'=> false,
        ]);

    }
}
