<?php
namespace App\Interfaces;
use Illuminate\Database\Eloquent\Collection;

interface IDictionaryRepo {
    public function search(string $word): Collection;
    public function detail(string $word);
}