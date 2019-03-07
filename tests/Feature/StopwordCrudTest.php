<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Stopword;
use App\User;
use Auth;
use StopWordFactory;

class StopwordCrudTest extends TestCase
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
    public function testUpdateStopword()
    {
        //pt
        $stopwords = StopWordFactory::get('stop-words_brazil_1_br.txt');
        $stoplist  = implode("\r\n", $stopwords);

        $response = $this->post('/stopwords/update', array('idioma' => 'pt', 'conteudo' => $stoplist));

        foreach ($stopwords as $palavra) {
            $this->assertDatabaseHas('stopwords', array('idioma' => 'pt', 'palavra' => $palavra));
        }

        //en
        $stopwords = StopWordFactory::get('stop-words_english_2_en.txt');
        $stoplist  = implode("\r\n", $stopwords);

        $response = $this->post('/stopwords/update', array('idioma' => 'en', 'conteudo' => $stoplist));

        foreach ($stopwords as $palavra) {
            $this->assertDatabaseHas('stopwords', array('idioma' => 'en', 'palavra' => $palavra));
        }
    }

    /**
    * @test read
    */
    public function testReadStopword()
    {
        $stopwords = StopWordFactory::get('stop-words_english_2_en.txt');
        $stoplist  = implode("\r\n", $stopwords);

        $response = $this->post('/stopwords/update', array('idioma' => 'en', 'conteudo' => $stoplist));

        $response = $this->get('/stopwords/en');
        $response->assertStatus(200);
        $response->assertSeeText(e($stoplist));
    }

}
