<?php

namespace App\Util;

class Censurator
{

    public function purify(string $string): string
    {
        $words = ['zut', 'mince', 'punaise'];

        foreach ($words as $word) {
            $asterisks = str_repeat('*', strlen($word));
            $string = str_ireplace($word, $asterisks, $string);
        }

        return $string;
    }

}