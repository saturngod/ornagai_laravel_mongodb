<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Myanmar extends FullTextSearchModel
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $collection = 'myanmar';

    protected $fillable = [
        'word',
        'source'
    ];

}
