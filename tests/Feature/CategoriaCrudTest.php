<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Categoria;
use App\User;
use Auth;

class CategoriaCrudTest extends TestCase
{
    /**
    * Setting up an auth user for testing the methods
    */
    public function setUp(): void
    {
        parent::setUp();

        $user = factory(User::class)->make();
        Auth::login($user, true);
    }

    /**
    * @test create
    */
    public function testCreateCategoria()
    {
        $categoria = factory(Categoria::class)->make();
        $response = $this->post('categorias', $categoria->toArray());
        $this->assertDatabaseHas('categorias', $categoria->toArray());


        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => Categoria::latest()->first()->id,
            'entidade_tipo' => 'categoria',
            'entidade_nome' => $categoria->nome,
            'operacao' => 'criado',
            ]
        );
    }

    /**
    * @test read
    */
    public function testReadCategoria()
    {
        $categoria = factory(Categoria::class)->create();
        $response = $this->get('/categorias/pt/' . $categoria->id);
        $response->assertStatus(200);
        $response->assertSeeText($categoria->nome);
    }

    /**
    * @test update
    */

    public function testUpdateCategoria()
    {
        $categoria = factory(Categoria::class)->create();

        // Edit page exists?
        $response = $this->get('categorias/' . $categoria->id . '/edit');
        $response->assertStatus(200);

        // edit
        $categoria->nome = $categoria->nome . ' Edited';
        $response = $this->patch('/categorias/' . $categoria->id, $categoria->toArray());
        $this->assertDatabaseHas('categorias', $categoria->toArray());

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => $categoria->id,
            'entidade_tipo' => 'categoria',
            'entidade_nome' => $categoria->nome,
            'operacao' => 'modificado',
            ]
        );
    }

    /**
    * @test delete
    */

    public function testDeleteCategoria()
    {
        $categoria = factory(Categoria::class)->create();
        $response = $this->delete('/categorias/' . $categoria->id);
        $this->assertNull(Categoria::find($categoria->id));

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => $categoria->id,
            'entidade_tipo' => 'categoria',
            'entidade_nome' => $categoria->nome,
            'operacao' => 'removido',
            ]
        );
    }

    /**
    * @test index
    */
    // public function testIndexCategoria()
    // {
    //     $categoria = factory(Categoria::class)->create();
    //     print_r(Categoria::paginate(10)->items());
    //     $response = $this->get('corpus?page=' . Categoria::paginate(10)->lastPage());
    //     $response->assertStatus(200);
    //     $response->assertSeeText($categoria->nome);
    // }

}
