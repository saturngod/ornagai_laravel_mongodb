<?php

namespace Tests\Unit;

use App\Repository\DictionaryRepo;
use App\Strategies\EnglishDictionary;
use App\Strategies\MyanmarDictionary;
use App\Utils\Utils;

use Illuminate\Support\Facades\DB;

use MongoDB\Laravel\Connection;
use Tests\TestCase;

class SearchTest extends TestCase
{
    protected Utils $utils;

    public function setUp(): void
    {
        parent::setUp();
        $this->utils = new Utils();
    }

    
    /**
     * A basic unit test example.
     */
    public function test_english_word_list(): void
    {
        $dictionaryRepo = new DictionaryRepo($this->utils);
        $dictionaryRepo->setDictionary(new EnglishDictionary());
        $searchWord = "hello";
        $result = $dictionaryRepo->search($searchWord);
        $this->assertEquals($searchWord,$result->first()->word);

    }

    public function test_myanmar_word_list(): void
    {
        $dictionaryRepo = new DictionaryRepo($this->utils);
        $dictionaryRepo->setDictionary(new MyanmarDictionary());
        $searchWord = "ကကတစ်";
        $result = $dictionaryRepo->search($searchWord);
        $this->assertEquals($searchWord,$result->first()->word);

    }
}
