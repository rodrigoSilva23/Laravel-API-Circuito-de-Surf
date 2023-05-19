<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\surfer;


class SurferControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllSurfersEndpoint(): void
    {

        surfer::factory(2)->create();
        $response = $this->getJson('/api/surfers');


        $this->assertIsArray($response->json());
        $response->assertJsonCount(2);

        $response->assertStatus(200);

        $this->assertIsInt($response[0]['id']);
        $this->assertIsString($response[0]['name']);
        $this->assertIsString($response[0]['country']);

        $this->assertArrayHasKey('id', $response[0]);
        $this->assertArrayHasKey('name', $response[0]);
        $this->assertArrayHasKey('country', $response[0]);
    }

    public function testGetSingleSurferEndpoint(): void
    {
        $surfer = surfer::factory(1)->create()->first();

        $response = $this->getJson('/api/surfers/' . $surfer->id);
        $response->assertStatus(200);
        // Verifica se a resposta é um array
        $this->assertIsArray($response->json());


        $this->assertIsInt($response['id']);
        $this->assertIsString($response['name']);
        $this->assertIsString($response['country']);

        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('country', $response);
    }


    public function testPostSurfersEndpoint(): void
    {
        // Cria um surfer válido
        $surfer = surfer::factory()->makeOne()->toArray();

        // Faz a requisição POST para /api/surfers com os dados do surfer
        $response = $this->postJson('/api/surfers', $surfer);

        // Verifica se a requisição foi bem-sucedida (código 201)
        $response->assertStatus(201);

        // Verifica se a resposta é um objeto JSON e contém as chaves esperadas
        $response->assertJsonStructure([
            'id',
            'name',
            'country',
        ]);

        // Verifica se as chaves têm os tipos esperados
        $response->assertJson([
            'name' => $surfer['name'],
            'country' => $surfer['country'],
        ]);


        $response = $this->postJson('/api/surfers', []);

        $response->assertJsonValidationErrors(['name','country']);
    }



    public function testPutSurfersEndpoint(): void
    {
        // Cria um surfer válido
        $surfer = surfer::factory(1)->create()->first();
        $data =[
            'id'=>$surfer->id,
            'name' =>'rafael',
            'country' => 'brasil'
        ];
        $response = $this->putJson('/api/surfers/'.$surfer->id, $data);

        // Verifica se a requisição foi bem-sucedida (código 200)
        $response->assertStatus(200);

        $response->assertJson([
            'isPutSuccessful'=> true,
            'message'=>'surfer changed successfully'
        ]);


        $response = $this->putJson('/api/surfers/'.$surfer->id,[]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['id']);

    }

    public function testDeletedSurfer(){
        $surfer = surfer::factory(1)->create()->first();
        $response = $this->delete('/api/surfers/'.$surfer->id);

        $response->assertStatus(200);
        $response->assertJson([
            'message'=> 'Surfer deleted successfully',
            'isDeletedSuccessful'=> true,
        ]);

        $response = $this->delete('/api/surfers/10');

        $response->assertStatus(404);
        $response->assertJson([
            'message'=> 'Surfer not found',
            'isDeletedSuccessful'=> false,
        ]);

    }
}
