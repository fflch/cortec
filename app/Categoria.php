<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\CategoriaChanged;
use App\Observers\CategoriaObserver;

class Categoria extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::observe(CategoriaObserver::class);
    }

    public function corpuses()
    {
        return $this->hasMany('App\Corpus');
    }
}
