<?php

namespace App\Http\Controllers\Image;

use App\Actions\Image\CreateAction;
use App\Dto\ImageDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;

class CreateController extends Controller
{
    public function store(StoreRequest $request, CreateAction $action): Model
    {
        $dto = ImageDto::fromRequest($request);

        return $action->execute($dto);
    }
}
