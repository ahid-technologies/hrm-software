<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeUtil
{
    public static function generateQrCode(string $token, string $path = 'qr-codes/')
    {
        $qrCode = QrCode::margin(2)
            ->size(400)
            ->format('png')
            ->errorCorrection('H')
            ->margin(0)
            ->generate(route('verify', $token));

        Storage::put($path . $token . '.png', $qrCode);

        return "{$path}{$token}.png";
    }
}
