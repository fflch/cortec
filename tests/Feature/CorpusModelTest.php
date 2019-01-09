<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpus;

class CorpusModelTest extends TestCase
{

    /**
     * @test create
     */
    public function testCreateCorpus()
    {
        $corpus = factory(Corpus::class)->create();
        $this->assertDatabaseHas('corpuses', $corpus->toArray());
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
    }

}
