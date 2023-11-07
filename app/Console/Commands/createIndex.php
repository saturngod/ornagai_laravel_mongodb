<?php

namespace App\Console\Commands;

use App\Models\English;
use App\Models\Myanmar;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;
use Elastic\Elasticsearch\ClientBuilder;

abstract class IndexDictionary
{
    protected $model;
    public function __construct(protected Client $client, $model)
    {
        $this->model = $model;
        $this->setupIndexParam();
    }

    private function setupIndexParam()
    {
        $params = [
            'index' => 'search_index',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'word' => [
                            'type' => 'text',  // Define the data type for the 'word' field
                        ],
                        // You can define more fields here if needed
                    ],
                ],
            ],
        ];

        try {

            // Create the index
            $response = $this->client->indices()->create($params);
        } catch (\Exception $e) {
            echo "Index create failed ", $e->getMessage(),"\n";
        }
    }
    public function doIndex(): void
    {
        $chunks = 500;
        $this->model::chunk($chunks, function ($records) {
            foreach ($records as $row) {
                $this->indexData($row->word, $row->toArray());
            }
        });
    }
    protected function indexData(string $word, array $data)
    {

        $params = [
            'index' => 'search_index',  // Specify the index where you want to store the document
            'body' => [
                'word' => $word,  // The data you want to index, in this case, the "word"
                // You can add more fields to the document if needed
            ],
        ];

        try {
            // Index the document in the specified index
            $response = $this->client->index($params);
        } catch (\Exception $e) {
            echo "Document indexing failed ", $e->getMessage(), "\n";
        }


    }
}

class EnglishIndex extends IndexDictionary
{
    public function __construct(Client $client)
    {
        parent::__construct($client, new English());
    }
}

class MyanmarIndex extends IndexDictionary
{
    public function __construct(Client $client)
    {
        parent::__construct($client, new Myanmar());
    }
}

class createIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $client = ClientBuilder::create()->build();

        $english = new EnglishIndex($client);
        $english->doIndex();

        $myanmar = new MyanmarIndex($client);
        $myanmar->doIndex();

    }
}
