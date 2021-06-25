<?php


namespace Claassenmarius\LaravelSkynet\Models;

use Claassenmarius\LaravelSkynet\Database\Factories\QuoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return QuoteFactory::new();
    }
}
