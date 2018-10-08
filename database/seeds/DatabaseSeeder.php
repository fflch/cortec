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
      factory(App\Categoria::class, 5)
        ->create()
        ->each(function($c) {
              $c->corporas()->saveMany(
                factory(App\Corpora::class, 5)
                  ->create()
                  ->each(function($cp) {
                        $cp->corpuses()->saveMany(factory(App\Corpus::class, 5)->make());
                    })
              );
      //     });
      //
      // factory(App\Categoria::class, 5)->create()->each(function ($c) {
      //   $c->corporas()->saveMany(factory(Posts::class, 5)->make());
      // });
      //
      // factory(App\Categoria::class, 5)->create()
      //           ->each(
      //               function ($c) {
      //                   factory(App\Corpora::class, 5)->create()
      //                           ->each(
      //                               function($cp) use (&$c) {
      //                                   $c->corpus()->save($cp)->make();
      //                               }
      //                           );
      //               }
      //           );

    }
}
