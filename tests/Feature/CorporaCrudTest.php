<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpora;

class CorporaCrudTest extends TestCase
{

    /**
     * @test index
     */
    public function testIndexCorpora()
    {
        $corpora = factory(Corpora::class)->make();
        $response = $this->get('/corpora');
        $response->assertStatus(200);
        $response->assertSeeText($corpora->titulo);
    }

    /**
     * @test create
     */
    public function testCreateCorpora()
    {
        $corpora = factory(Corpora::class)->make();
        $response = $this->post('corporas', $corpora->toArray());
        $this->assertDatabaseHas('corporas', $corpora->toArray());
    }

    /**
     * @test read
     */
    public function testReadCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $response = $this->get('/corpora/' . $corpora->id);
        $response->assertStatus(200);
        $response->assertSeeText($corpora->titulo);
    }

    /**
     * @test update
     */

    public function testUpdateCorpora()
    {
        $corpora = factory(Corpora::class)->create();

        // Edit page exists?
        $response = $this->get('corpora/' . $corpora->id . '/edit');
        $response->assertStatus(200);

        // edit
        $corpora->titulo = $corpora->titulo . ' Edited';    
        $response = $this->patch('/corpora/' . $corpora->id, $corpora->toArray());
        $this->assertDatabaseHas('corporas', $corpora->toArray());
    }

    /**
     * @test delete
     */

    public function testDeleteCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $response = $this->delete('/redes/' . $rede->id);
        $this->assertNull(Corpora::find($corpora->id));
    }
}
