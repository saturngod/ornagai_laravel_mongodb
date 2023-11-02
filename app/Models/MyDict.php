<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyDict extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'mydict';

    protected $fillable = [
        'word',
        'myen'
    ];
}
