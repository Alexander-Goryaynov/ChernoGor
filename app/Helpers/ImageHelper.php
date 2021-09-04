<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class ImageHelper
{
    /**
     * @param string $baseCode Base64-encoded image (.png or .jpeg)
     * @param string $folder Storage folder (must end with a slash)
     * @return string New image's path in local filesystem
     */
    public static function saveOnDisk(string $baseCode, string $folder, int $width, int $height): string
    {
        $baseParts = explode(',', $baseCode);
        $imageCode = $baseParts[1];
        $imageExtension = (Str::of($baseParts[0])->contains('png')) ? '.png' : '.jpeg';
        $dataToWrite = base64_decode($imageCode);
        $newFilePathInStorage = $folder . Str::random() . $imageExtension;
        Storage::put($newFilePathInStorage, $dataToWrite);
        static::resize($newFilePathInStorage, $width, $height);
        return $newFilePathInStorage;
    }

    private static function resize(string $path, int $newWidth, int $newHeight): void
    {
        ImageManagerStatic::make(Storage::path($path))
            ->resize($newWidth, $newHeight)
            ->save();
    }
}
