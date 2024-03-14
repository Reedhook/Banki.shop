<?php

namespace App\Actions\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class GetImagesAction
{
    public function execute()
    {
        $files = Storage::files('public/images'); // Путь к папке c изображениями
        $previewFiles = collect($files)->map(function($file) {
            $filename = basename($file);
            $originalFilename = str_replace(['preview_', 'original_'], '', $filename);

            // Получите данные из базы данных по названию файла без префиксов
            $imageData = Image::where('name', $originalFilename)->first();

            $data = [
                'name' => $imageData ? $imageData->name : 'Нет данных в базе данных',
            ];

            if (str_contains($filename, 'original_')) {
                $data['original'] = $filename;
            } elseif (str_contains($filename, 'preview_')) {
                $data['preview'] = $filename;
            }

            return $data;
        })->groupBy('name')->map(function ($group) {
            $mergedData = $group->reduce(function($carry, $item) {
                return array_merge($carry, $item);
            }, []);

            return $mergedData;
        });

        return response()->json(['files' => $previewFiles]);
    }
}
