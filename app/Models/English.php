<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class English extends FullTextSearchModel
{
    use HasFactory;

    protected $collection = 'english';

    protected $fillable = [
        'word',
        'source'
    ];


}
