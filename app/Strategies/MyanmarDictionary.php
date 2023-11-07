<?php

namespace App\Strategies;
use App\Models\Myanmar;
use App\Models\MyDict;
use BaseDictionary;
use Illuminate\Database\Eloquent\Collection;

class MyanmarDictionary extends BaseDictionary {
    protected $model = Myanmar::class;

    public function detail(string $word): Collection {
        return MyDict::where("word", $word)->get();
    }
}