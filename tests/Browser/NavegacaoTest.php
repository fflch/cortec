<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavegacaoTest extends DuskTestCase
{
    public function test_navegacao()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->assertSee('Home');

            $browser->visit('/login')
                ->waitFor('#loginUsuario')
                ->type('#callback', 'http://cortec/callback')
                ->type('#loginUsuario', '1111')
                ->pause(1000)
                ->press('Login')
                ->visit('/');

            $browser->visit('/corpus')
                ->assertSee('Lista de Corpora')
                ->pause(1000)                
                ->visit('/categorias/create')
                ->assertSee('Nome')
                ->pause(1000)                
                ->visit('/corpus/create')
                ->assertSee('Categoria')
                ->pause(1000)
                ->visit('/changes')
                ->assertSee('ID da Entidade')
                ->pause(1000)                
                ->visit('/stopwords/pt')
                ->assertSee('Conteúdo')
                ->pause(1000)                
                ->visit('/stopwords/en')
                ->assertSee('Conteúdo')
                ->pause(1000)
                ->visit('/avisos/create')
                ->assertSee('Exibição de aviso')
                ->pause(1000) 
                ->visit('/')
                ->assertSee('Corpora')
                ->pause(1000);                
        });
    }
}
