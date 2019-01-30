<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpus;
use App\Categoria;
use App\User;
use Auth;

class CorpusCrudTest extends TestCase
{

    /**
    * Setting up an auth user for testing the methods
    */
    public function setUp()
    {
        parent::setUp();

        $user = factory(User::class)->make();
        Auth::login($user, true);
    }

    /**
    * @test create
    */
    public function testCreateCorpus()
    {
        $corpus = factory(Corpus::class)->make();
        $response = $this->post('corpus', $corpus->toArray());
        $this->assertDatabaseHas('corpuses', $corpus->toArray());
    }

    /**
    * @test read
    */
    public function testReadCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $response = $this->get('/categorias/' . $corpus->categoria_id);
        $response->assertStatus(200);
        $response->assertSeeText($corpus->titulo);
        $response->assertSeeText($corpus->descricao);
    }

    /**
    * @test update
    */

    public function testUpdateCorpus()
    {
        $corpus = factory(Corpus::class)->create();

        // Edit page exists?
        $response = $this->get('corpus/' . $corpus->id . '/edit');
        $response->assertStatus(200);

        // edit
        $corpus->titulo = $corpus->titulo . ' Edited';
        $response = $this->patch('/corpus/' . $corpus->id, $corpus->toArray());
        $this->assertDatabaseHas('corpuses', $corpus->toArray());
    }

    /**
    * @test delete
    */

    public function testDeleteCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $response = $this->delete('/corpus/' . $corpus->id);
        $this->assertNull(Corpus::find($corpus->id));
    }

    /**
    * @test index
    */
    public function testIndexCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $response = $this->get('corpus?page=' . Categoria::paginate(10)->lastPage());
        $response->assertStatus(200);
        $response->assertSeeText($corpus->titulo);
    }
}
