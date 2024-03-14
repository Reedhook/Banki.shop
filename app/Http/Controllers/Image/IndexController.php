<?php

namespace App\Http\Controllers\Image;

use App\Actions\Image\GetImagesAction;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Repositories\IndexRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected IndexRepositories $indexRepositories;

    public function __construct(IndexRepositories $indexRepositories)
    {
        $this->indexRepositories = $indexRepositories;
    }

    public function index(): JsonResponse
    {
        $response = $this->indexRepositories->all(new Image());
        return $this->OkResponse($response, 'images');
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->indexRepositories->getByObject(new Image(), $id);
        return $this->OkResponse($response, 'image');
    }

    public function getImages(GetImagesAction $action)
    {
        return $action->execute();
    }
}
