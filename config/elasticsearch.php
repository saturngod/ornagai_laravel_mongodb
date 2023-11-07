<?php

return [
    'hosts' => explode(',', env('ELASTICSEARCH_HOSTS', 'localhost:9200')),
];