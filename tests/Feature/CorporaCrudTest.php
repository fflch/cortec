<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpora;
use App\Categoria;

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
        $response = $this->get('/categorias/' . $corpora->categoria_id);
        $response->assertStatus(200);
        $response->assertSeeText($corpora->titulo);
        $response->assertSeeText($corpora->descricao);
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
        $response = $this->get('corporas?page=' . Categoria::paginate(10)->lastPage());
        $response->assertStatus(200);
        $response->assertSeeText($corpora->titulo);
    }
}
