<?php

namespace App\Strategies;
use App\Interfaces\ILanguageDictionary;
use App\Models\Myanmar;
use App\Models\MyDict;
use Illuminate\Database\Eloquent\Collection;

class MyanmarDictionary implements ILanguageDictionary {
    public function search(string $word,string $select = "*",int $limit = 30): array {
        $results = Myanmar::select($select)->project(['_id' => 0])->where("word","like",$word ."%")->limit($limit)->get();
        $words = [];
        foreach ($results as $result) {
            $words[] = $result->word;
        }
        return $words;
    }

    public function detail(string $word): Collection {
        return MyDict::where("word",$word)->get();
    }
}
