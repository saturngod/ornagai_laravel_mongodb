<?php

namespace App\Http\Controllers;

use App\Repository\DictionaryRepo;
use App\Strategies\EnglishDictionary;
use App\Strategies\MyanmarDictionary;
use App\Utils\Utils;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    function __construct(protected DictionaryRepo $dictionaryRepo) {}
    function search(Request $request) {
        $request->validate([
            'word' => 'required'
        ]);
        $utils = new Utils();

        if($utils->isMyanmar($request->word, )) {
            $this->dictionaryRepo->setDictionary(new MyanmarDictionary());
        }
        else {
            $this->dictionaryRepo->setDictionary(new EnglishDictionary());
        }

        $result = $this->dictionaryRepo->search($request->word,"word");
        return response()->json($result);
        
    }
}
