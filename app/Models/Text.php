<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\TextObserver;

class Text extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::observe(TextObserver::class);
    }

    public function corpus()
    {
        return $this->belongsTo(Corpus::class);
    }
}
