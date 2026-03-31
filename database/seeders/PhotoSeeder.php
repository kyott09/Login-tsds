<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        if (!Storage::disk('public')->exists('photos')) {
            Storage::disk('public')->makeDirectory('photos');
        }

        $sourcePath = public_path('img/users_profile/gallery/photo');
        $images = [
            ['file' => 'FOTO1.JPEG', 'title' => ''],
            ['file' => 'FOTO2.JPEG', 'title' => ''],
            ['file' => 'FOTO3.JPEG', 'title' => ''],
            ['file' => 'FOTO4.JPEG', 'title' => ''],
        ];

        foreach ($images as $img) {
            $originalFile = $sourcePath . DIRECTORY_SEPARATOR . $img['file'];

            if (file_exists($originalFile)) {
                $destinationFile = 'photos/' . $img['file'];
                Storage::disk('public')->put($destinationFile, file_get_contents($originalFile));

                Photo::create([
                    'title' => $img['title'],
                    'image_path' => $destinationFile,
                ]);
            } else {
                $this->command->warn("⚠️ No se encontró el archivo: {$img['file']}");
            }
        }
    }
}