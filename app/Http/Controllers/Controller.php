<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function OkResponse(Model|Collection $model, string $alias = 'data'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'body' => [
                $alias => $model
            ]
        ]);
    }
}
