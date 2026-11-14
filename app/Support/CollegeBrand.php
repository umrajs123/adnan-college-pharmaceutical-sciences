<?php

namespace App\Support;

class CollegeBrand
{
    public static function copy(?string $text): ?string
    {
        if ($text === null) {
            return null;
        }

        return str_replace(
            ['Swat College of Pharmaceutical Sciences', 'Swat College', 'SCPS'],
            [config('college.name'), 'Adnan College', 'ACPS'],
            $text
        );
    }
}
