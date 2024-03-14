<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface DataServiceInterface
{
    public function create(Model $model, $dto);
}
