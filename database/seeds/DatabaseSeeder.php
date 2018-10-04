<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Corpora::class, 30)
          ->create()
          ->each(function($c) {
                $c->corpuses()->saveMany(factory(App\Corpus::class, 5)->make());
            });

    }
}
