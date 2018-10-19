<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpus;

class CorpusCrudTest extends TestCase
{
  /**
   * @test create
   */
  public function testCreateCorpus()
  {
    $corpus = factory(Corpus::class)->make();
    $response = $this->post('corporas/'.$corpus->corpora_id.'/corpus', $corpus->toArray());
    $this->assertDatabaseHas('corpuses', $corpus->toArray());
  }

  /**
   * @test read
   */
  public function testReadCorpus()
  {
    $corpus = factory(Corpus::class)->create();
    $response = $this->get('corporas/'.$corpus->corpora_id.'/corpus/'.$corpus->id.'/edit');
    $response->assertStatus(200);
    $response->assertSeeText($corpus->conteudo);
  }

  /**
   * @test update
   */

  public function testUpdateCorpus()
  {
    $corpus = factory(Corpus::class)->create();

    // Edit page exists?
    $response = $this->get('corporas/'.$corpus->corpora_id.'/corpus/'.$corpus->id.'/edit');
    $response->assertStatus(200);

    // edit
    $corpus->conteudo = $corpus->conteudo . ' Edited';
    $response = $this->post('/corporas/'.$corpus->corpora_id.'/corpus/'.$corpus->id, $corpus->toArray());
    $this->assertDatabaseHas('corpuses', $corpus->toArray());
  }

  /**
   * @test delete
   */

  public function testDeleteCorpus()
  {
      $corpus = factory(Corpus::class)->create();
      $response = $this->delete('/corporas/'.$corpus->corpora_id.'/corpus/' . $corpus->id);
      $this->assertNull(Corpus::find($corpus->id));
  }

}
