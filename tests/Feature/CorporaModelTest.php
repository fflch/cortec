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
        $createdCorpora = factory(Corpora::class)->create();
        $createdCorpora = $createdCorpora->toArray();
        $this->assertArrayHasKey('id', $createdCorpora);
        $this->assertNotNull($createdCorpora['id'], 'Created Corpora must have id specified');
        $this->assertNotNull(Corpora::find($createdCorpora['id']), 'Corpora with given id must be in DB');
        $this->assertModelData($corpora, $createdCorpora);
    }

    /**
     * @test read
     */
    public function testReadCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $this->assertDatabaseHas('corpora', $corpora->toArray());
    }

    /**
     * @test update
     */
    public function testUpdateCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        // Not Implemented
    }

    /**
     * @test delete
     */
    public function testDeleteCorpora()
    {
        $corpora = factory(Corpora::class)->create();
        $resp = $this->corporaRepo->delete($corpora->id);
        $this->assertTrue($resp);
        $this->assertNull(Corpora::find($corpora->id), 'Corpora should not exist in DB');
    }
}
