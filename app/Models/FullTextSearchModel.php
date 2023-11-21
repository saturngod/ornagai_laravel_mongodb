<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class FullTextSearchModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    public function scopeWhereFullText($query, $search)
    {
        $query->getQuery()->projections = ['score' => ['$meta' => 'textScore']];

        return $query->whereRaw(['$text' => ['$search' => $search]]);

    }
}


