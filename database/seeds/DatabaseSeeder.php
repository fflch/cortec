<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    public function run()
    {
        //Evita a execução de event listeners
        Event::fake();

        factory(App\Text::class, 10)->create();

    }
}
