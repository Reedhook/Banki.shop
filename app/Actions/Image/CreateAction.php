<?php

namespace App\Actions\Image;

use App\Dto\ImageDto;
use App\Models\Image;
use App\Services\DbServices;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class CreateAction
{
    protected UploadImageAction $uploadImageAction;
    protected FileService $fileService;
    protected DbServices $dbServices;
    public function __construct(UploadImageAction $uploadImageAction, FileService $fileService, DbServices $dbServices)
    {
        $this->uploadImageAction = $uploadImageAction;
        $this->fileService = $fileService;
        $this->dbServices=$dbServices;
    }

    public function execute(ImageDto $dto): Model
    {
        // транслитерируем имя файла
        $name = $this->fileService->transliterated($dto);

        // Проверка на существование файла с таким же названием в бд
        $dto->name = Image::where('name', $name)->exists() ? Uuid::uuid4()->toString() .'.'. $dto->image->getClientOriginalExtension() : $name;

        // Отправляем данные сохранить в storage
        $this->uploadImageAction->execute($dto);

        // Создание записи в бд
        return $this->dbServices->create(new Image(), $dto);

    }
}
