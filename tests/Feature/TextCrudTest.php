<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Text;
use App\User;
use Auth;

class TextCrudTest extends TestCase
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
    public function testCreateText()
    {
        $text = factory(Text::class)->make();
        $response = $this->post('corpus/'.$text->corpus_id.'/text', $text->toArray());
        $this->assertDatabaseHas('texts', $text->toArray());

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_tipo' => 'text',
            'operacao' => 'criado',
            ]
        );
    }

    /**
    * @test read
    */
    public function testReadText()
    {
        $text = factory(Text::class)->create();
        $response = $this->get('corpus/'.$text->corpus_id.'/text/'.$text->id.'/edit');
        $response->assertStatus(200);
        $response->assertSeeText(e($text->conteudo));
    }

    /**
    * @test update
    */

    public function testUpdateText()
    {
        $text = factory(Text::class)->create();

        // Edit page exists?
        $response = $this->get('corpus/'.$text->corpus_id.'/text/'.$text->id.'/edit');
        $response->assertStatus(200);

        // edit
        $text->conteudo = $text->conteudo . ' Edited';
        $response = $this->post('/corpus/'.$text->corpus_id.'/text/'.$text->id, $text->toArray());
        $response_template = $this->get('corpus/'.$text->corpus_id.'/text/'.$text->id.'/edit');
        $response_template->assertStatus(200);
        $response_template->assertSeeText(e($text->conteudo));

        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => $text->id,
            'entidade_tipo' => 'text',
            'operacao' => 'modificado',
            ]
        );
    }

    /**
    * @test delete
    */

    public function testDeleteText()
    {
        $text = factory(Text::class)->create();
        $response = $this->delete('/corpus/'.$text->corpus_id.'/text/' . $text->id);
        $this->assertNull(Text::find($text->id));



        //change table
        $this->assertDatabaseHas('changes', [
            'user_id' => Auth::user()->id,
            'entidade_id' => $text->id,
            'entidade_tipo' => 'text',
            'operacao' => 'removido',
            ]
        );
    }

}
