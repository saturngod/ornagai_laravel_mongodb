<?php

namespace App\Http\Controllers;

use App\Repository\DictionaryRepo;
use App\Strategies\ElasticSearchDictionary;
use App\Strategies\EnglishDictionary;
use App\Strategies\MyanmarDictionary;
use App\Utils\Utils;

use Elastic\Elasticsearch\Client;
use Illuminate\Http\Request;
use MongoDB\Laravel\Eloquent\Model;

class SearchController extends Controller
{
    public function __construct(protected DictionaryRepo $dictionaryRepo, protected Utils $utils, protected Client $elasticSearch) {}
    
    private function _setupDictionary(string $word) {
            $elasticSearchDictionary = new ElasticSearchDictionary($this->elasticSearch);
        if($this->utils->isMyanmar($word)) {
            $elasticSearchDictionary->setDictionary(new MyanmarDictionary());
            
        } else {
            $elasticSearchDictionary->setDictionary(new EnglishDictionary());
        }
        $this->dictionaryRepo->setDictionary($elasticSearchDictionary);
    }

    private function _search(string $word) {
        return $this->dictionaryRepo->search($word, "word");
    }

    private function _getDictionaryDetail(string $word): Model {
        return $this->dictionaryRepo->detail($word);
    }

    public function search(Request $request)
    {
        $request->validate([
            'word' => 'required'
        ]);
        
        $this->_setupDictionary($request->word);
        
        $result = $this->_search($request->word);
        
        return response()->json($result);

    }

    public function detail(Request $request)
    {
        if($request->word == "") {
            abort(404);
        }

        $this->_setupDictionary($request->word);

        $data = $this->_getDictionaryDetail($request->word);
        $word = $request->word;
        return view('home/index',compact('data','word'));
        

    }
}
