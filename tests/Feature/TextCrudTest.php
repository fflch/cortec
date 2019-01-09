<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Text;

class TextCrudTest extends TestCase
{
  /**
   * @test create
   */
  public function testCreateText()
  {
    $text = factory(Text::class)->make();
    $response = $this->post('corpus/'.$text->corpus_id.'/text', $text->toArray());
    $this->assertDatabaseHas('texts', $text->toArray());
  }

  /**
   * @test read
   */
  public function testReadText()
  {
    $text = factory(Text::class)->create();
    $response = $this->get('corpus/'.$text->corpus_id.'/text/'.$text->id.'/edit');
    $response->assertStatus(200);
    $response->assertSeeText($text->conteudo);
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
    $response_template->assertSeeText($text->conteudo);
  }

  /**
   * @test delete
   */

  public function testDeleteText()
  {
      $text = factory(Text::class)->create();
      $response = $this->delete('/corpus/'.$text->corpus_id.'/text/' . $text->id);
      $this->assertNull(Text::find($text->id));
  }

}
