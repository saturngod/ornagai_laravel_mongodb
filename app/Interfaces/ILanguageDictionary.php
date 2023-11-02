<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ILanguageDictionary {
    public function search(string $word,string $select = "*",int $limit = 30): Collection;
    public function detail(string $word): Collection;
}