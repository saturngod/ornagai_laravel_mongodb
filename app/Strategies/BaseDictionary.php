<?php
namespace App\Strategies;

use App\Interfaces\ILanguageDictionary;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseDictionary implements ILanguageDictionary {
    protected $model;

    public function search(string $word, string $select = "*", int $limit = 30): array {
        $results = $this->model::select($select)->project(['_id' => 0])->where("word", "like", $word . "%")->limit($limit)->get();
        $words = [];
        foreach ($results as $result) {
            $words[] = $result->word;
        }
        return $words;
    }

    abstract public function detail(string $word): Collection;
}