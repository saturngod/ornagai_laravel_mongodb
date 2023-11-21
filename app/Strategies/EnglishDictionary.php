<?php

namespace App\Strategies;

use App\Models\Dict;
use App\Models\English;

use Illuminate\Database\Eloquent\Collection;

class EnglishDictionary extends BaseDictionary {
    protected $model = English::class;

    public function detail(string $word): Collection {
        return Dict::where("word", $word)->get();
    }
}
