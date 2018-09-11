<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpora;

class CorporaCrudTest extends TestCase
{

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
        $response = $this->get('/corporas/' . $corpora->id);
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
        $response = $this->get('corporas/' . $corpora->id . '/edit');
        $response->assertStatus(200);

        // edit
        $corpora->titulo = $corpora->titulo . ' Edited';
        $response = $this->patch('/corporas/' . $corpora->id, $corpora->toArray());
        $this->assertDatabaseHas('corporas', $corpora->toArray());
    }

    /**
     * @test delete
     */

    public function testDeleteCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $response = $this->delete('/corporas/' . $corpora->id);
        $this->assertNull(Corpora::find($corpora->id));
    }

    /**
     * @test index
     */
    public function testIndexCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $response = $this->get('corporas');
        $response->assertStatus(200);
        $response->assertSeeText($corpora->titulo);
    }
}
