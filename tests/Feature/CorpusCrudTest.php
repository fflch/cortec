<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpus;
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
        $corpus = factory(Corpus::class)->create();
        $this->assertDatabaseHas('corpuses', $corpus->toArray());

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_tipo' => 'corpus',
            'entidade_nome' => $corpus->titulo,
            'operacao' => 'criado',
            ]
        );
    }

    /**
    * @test read
    */
    public function testReadCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $this->assertNotNull(Corpus::find($corpus['id']));
    }

    /**
    * @test update
    */

    public function testUpdateCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $corpus_updated = Corpus::find($corpus['id']);

        // updated title field
        $corpus_updated->titulo = $corpus_updated->titulo . ' updated';
        $corpus_updated->descricao = $corpus_updated->descricao . ' updated';
        $corpus_updated->save();
        $this->assertDatabaseHas('corpuses', $corpus_updated->toArray());

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => $corpus_updated->id,
            'entidade_tipo' => 'corpus',
            'entidade_nome' => $corpus_updated->titulo,
            'operacao' => 'modificado',
            ]
        );
    }

    /**
    * @test delete
    */

    public function testDeleteCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $corpus = Corpus::find($corpus['id']);
        $this->assertTrue($corpus->delete());
        $this->assertNull(Corpus::find($corpus->id));

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => $corpus->id,
            'entidade_tipo' => 'corpus',
            'entidade_nome' => $corpus->titulo,
            'operacao' => 'removido',
            ]
        );
    }

}
