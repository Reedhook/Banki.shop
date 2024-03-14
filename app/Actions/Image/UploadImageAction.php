<?php

namespace App\Actions\Image;

use App\Dto\ImageDto;
use App\Services\FileService;

class UploadImageAction
{
    protected FileService $fileService;
    public function __construct(FileService $fileService)
    {
        $this->fileService=$fileService;
    }

    public function execute(ImageDto $dto): void
    {
        $this->fileService->storePreview($dto);
        $this->fileService->storeOriginal($dto);
    }

}
