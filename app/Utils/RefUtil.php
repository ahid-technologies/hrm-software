<?php

namespace App\Utils;

use App\Models\Student;

class RefUtil
{
    public static function generateRef()
    {
        $ref = 'GA' . '-' . 0 . now()->format('y') . '-' . rand(1000, 1999) . '-' . rand(1000, 1999);
        while (Student::where('ref', $ref)->exists()) {
            $ref = 'GA' . '-' . 0 . now()->format('y') . '-' . rand(1000, 1999) . '-' . rand(1000, 1999);
        }

        return $ref;
    }
}
