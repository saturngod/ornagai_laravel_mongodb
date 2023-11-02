<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Dict extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $collection = 'dict';

    protected $fillable = [
        'word',
        'type',
        'oxford',
        "ornagai",
        'synonym'
    ];

    
}
