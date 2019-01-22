<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\TextObserver;

class Text extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::observe(TextObserver::class);
    }

    public function corpus()
    {
        return $this->belongsTo('App\Corpus');
    }
}
