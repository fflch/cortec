<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_login(): void
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
        });
    }
}
