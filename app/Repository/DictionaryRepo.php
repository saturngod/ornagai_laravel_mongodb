<?php

namespace App\Repository;

use App\Interfaces\IDictionaryRepo;
use App\Interfaces\ILanguageDictionary;
use App\Models\English;
use App\Models\Myanmar;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Collection;
class DictionaryRepo implements IDictionaryRepo {

    private ILanguageDictionary $dictionary;

    public function __construct(protected Utils $utils) {}

    public function setDictionary(ILanguageDictionary $dictionary) {
        $this->dictionary = $dictionary;
    }

    public function search(string $word,string $select = "*"): Collection {
        return $this->dictionary->search($word, $select);
    }
    public function detail(string $word): Collection {
        return $this->dictionary->detail($word);
    }
}