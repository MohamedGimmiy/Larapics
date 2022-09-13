<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public static function makeDirectory()
    {
        # code...
        $subfolder = 'images/'.date('Y/m/d');
        Storage::makeDirectory($subfolder);
        return $subfolder;
    }
}
