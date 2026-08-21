<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Categoria;
use App\Models\Corpus;

class CrudTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');
    }

    public function test_crud()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->assertSee('Home');

            # Login
            $browser->visit('/login')
                ->waitFor('#loginUsuario')
                ->type('#callback', 'http://cortec/callback')
                ->type('#loginUsuario', '1111')
                ->pause(1000)
                ->press('Login')
                ->visit('/');

            # Create
                # C/ Categoria
            $browser->visit('/categorias/create')
                ->waitFor('#nome')
                ->type('#nome', 'Categoria Teste')
                ->press('Salvar')
                ->waitForLocation('/corpus');

            $categoria = Categoria::where('nome', 'Categoria Teste')->firstOrFail();
                # C/ Corpus
            $browser->visit('/corpus/create')
                ->select('categoria_id', $categoria->id)
                ->type('#titulo', 'Corpus Teste')
                ->type('#ckeditor', 'Descrição do Corpus Teste')
                ->type('#tipologia', 'Tipologia do Corpus Teste')
                ->type('#compilador', 'Compilador do Corpus Teste')
                ->type('#ano', '2026')
                ->press('Salvar')
                ->waitForLocation('/corpus');

            $corpus = Corpus::where('titulo', 'Corpus Teste')->firstOrFail();

            $browser->visit('/corpus/'.$corpus->id.'/text')
                ->visit('/corpus/'.$corpus->id.'/text/create')
                ->waitFor('#idioma')
                ->type('#conteudo', 'Texto Teste')
                ->press('Salvar')
                ->waitForLocation('/corpus/'.$corpus->id.'/text')
                ->visit('/corpus/'.$corpus->id.'/text/create')
                ->waitFor('#idioma')
                ->select('#idioma', 'en')
                ->type('#conteudo', 'Texto Teste Inglês')
                ->press('Salvar')
                ->waitForLocation('/corpus/'.$corpus->id.'/text');

            # Read 
            $browser->visit('/corpus')
                ->waitForText('Categoria Teste', 10)
                ->waitForText('Corpus Teste', 10)
                ->assertSee('Categoria Teste')
                ->assertSee('Corpus Teste'); 
                
            # Update
            $browser->visit('/corpus/'.$corpus->id.'/edit')
                ->waitFor('#titulo')
                ->type('#titulo', 'Corpus Teste Editado')
                ->press('Salvar')
                ->waitForLocation('/corpus')
                ->assertSee('Corpus Teste Editado');
            
            $browser->visit('/categorias/'.$categoria->id.'/edit')
                ->waitFor('#nome')
                ->type('#nome', 'Categoria Teste Editada')
                ->press('Salvar')
                ->waitForLocation('/corpus')
                ->assertSee('Categoria Teste Editada');

            # Delete
            $browser->visit('/corpus')
                ->waitFor("form[action='/corpus/{$corpus->id}'] button[type='submit']")
                ->click("form[action='/corpus/{$corpus->id}'] button[type='submit']")
                ->acceptDialog()
                ->pause(1000)
                ->assertDontSee('Corpus Teste Editado');

            $browser->visit('/corpus')
                ->waitFor("form[action='/categorias/{$categoria->id}'] button[type='submit']")
                ->click("form[action='/categorias/{$categoria->id}'] button[type='submit']")
                ->acceptDialog()
                ->pause(1000)
                ->assertDontSee('Categoria Teste Editada');

        });
    }
}
