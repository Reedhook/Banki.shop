<?php

namespace App\Services;

use App\Dto\ImageDto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class FileService
{
    public function transliterated(ImageDto $dto): string
    {
        return Str::slug(pathinfo($dto->name,
                PATHINFO_FILENAME)) . '.' . $dto->image->getClientOriginalExtension();
    }

    public function storePreview(ImageDto $dto): void
    {
        // Проверяем, существует ли папка images, и если нет - создаем ее
        if (!Storage::exists('public/images')) {
            Storage::makeDirectory('public/images');
        }

        $image = ImageManager::imagick()->read($dto->image);
        $image->resize(100,100)->save(storage_path('app/public/images/'.'preview_'.$dto->name));
    }

    public function storeOriginal(ImageDto $dto): void
    {
        $dto->image->storeAs('public/images', 'original_'. $dto->name);
    }

}
