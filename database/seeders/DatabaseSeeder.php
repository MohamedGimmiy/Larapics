<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $images = Storage::allFiles('images');
        foreach($images as $image){
            Image::factory()->create([
                'file' => $image,
                'dimension' => $this->getDimension($image)
            ]);
        }
    }

    protected function getDimension($image)
    {
        # code...
        [$width, $height] = getimagesize(Storage::path($image));
        return $width . 'x'. $height;
    }
}
