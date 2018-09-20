<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Corpora;

class CorporaModelTest extends TestCase
{

    /**
     * @test create
     */
    public function testCreateCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $this->assertDatabaseHas('corporas', $corpora->toArray());
    }

    /**
     * @test read
     */
    public function testReadCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $this->assertNotNull(Corpora::find($corpora['id']));
    }

    /**
     * @test update
     */

    public function testUpdateCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $corpora_updated = Corpora::find($corpora['id']);

        // updated title field
        $corpora_updated->titulo = $corpora_updated->titulo . ' updated';
        $corpora_updated->descricao = $corpora_updated->descricao . ' updated';
        $corpora_updated->save();
        $this->assertDatabaseHas('corporas', $corpora_updated->toArray());
    }

    /**
     * @test delete
     */

    public function testDeleteCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $corpora = Corpora::find($corpora['id']);
        $this->assertTrue($corpora->delete());
        $this->assertNull(Corpora::find($corpora->id));
    }

}
