<?php

namespace App\Strategies;
use App\Interfaces\ILanguageDictionary;
use App\Models\Dict;
use App\Models\English;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticSearchDictionary implements ILanguageDictionary {
    protected ILanguageDictionary $dictionary;
    function __construct( protected Client $client) {
        
    }

    public function setDictionary(ILanguageDictionary $dictionary) {
        $this->dictionary = $dictionary;
    }
    public function search(string $word,string $select = "*",int $limit = 30): array {
        $params = [
            'index' => 'search_index',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'wildcard' => [
                                    'word' => "$word*",
                                ],
                            ],
                            [
                                'wildcard' => [
                                    'word' => "*$word",
                                ],
                            ],
                            [
                                'wildcard' => [
                                    'word' => "*$word",
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        
        try {
            $response = $this->client->search($params);
            // Process the search results
            $hits = $response['hits']['hits'];
            $words = [];
            foreach ($hits as $hit) {
                // Access the "word" field from the "_source" part of each hit
                $word = $hit['_source']['word'];
                $words[] = $word;
                
            }
            
            return $words;
        } catch (\Exception $e) {
            echo "Search failed: ", $e->getMessage(), "\n";
        }
        return [];
    }
    public function detail(string $word): Collection {
        return $this->dictionary->detail($word);
    }
}
