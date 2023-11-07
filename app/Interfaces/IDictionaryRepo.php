<?php
namespace App\Interfaces;
use Illuminate\Database\Eloquent\Collection;

interface IDictionaryRepo {
    public function search(string $word): array;
    public function detail(string $word);
}