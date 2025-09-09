<?php

namespace App\Utils;

use App\Models\Enrollment;
use Illuminate\Support\Str;

class TokenUtil
{
    public static function generateToken()
    {
        $token = Str::random(12);
        while (Enrollment::where('token', $token)->exists()) {
            $token = Str::random(12);
        }

        return Str::upper($token);
    }
}
