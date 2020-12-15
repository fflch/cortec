<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\CategoriaChanged;
use App\Observers\CategoriaObserver;

class Categoria extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::observe(CategoriaObserver::class);
    }

    public function corpuses()
    {
        return $this->hasMany(Corpus::class);
    }
}
