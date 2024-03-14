<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class IndexRepositories
{
    public function all(Model $model): Collection
    {
        return $model::all();
    }

    public function getByObject(Model $model, int $id){
        return $model::findOrFail($id);
    }
}
