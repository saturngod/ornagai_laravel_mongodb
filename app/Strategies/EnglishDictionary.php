<?php

namespace App\Strategies;
use App\Interfaces\ILanguageDictionary;
use App\Models\Dict;
use App\Models\English;
use Illuminate\Database\Eloquent\Collection;

class EnglishDictionary implements ILanguageDictionary {
    public function search(string $word,string $select = "*",int $limit = 30): Collection {
        return English::select($select)->project(['_id' => 0])->where("word","like",$word . "%")->limit($limit)->get();
    }
    public function detail(string $word): Collection {
        return Dict::where("word",$word)->get();
    }
}
