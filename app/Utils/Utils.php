<?php

namespace App\Utils;

use App\Interfaces\IUtilities;

class Utils implements IUtilities {

    private function isWordInRange(string $word, $start, $end): bool {
        $pattern = "/^[" . preg_quote(mb_chr($start, 'UTF-8'), '/') . "-" . preg_quote(mb_chr($end, 'UTF-8'), '/') . "]+$/u";
    return preg_match($pattern, $word) === 1;
    }
    

    public function isMyanmar(string $word): bool {
        return $this->isWordInRange($word,0x1000,0x109F);
    }
}