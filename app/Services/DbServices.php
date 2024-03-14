<?php

namespace App\Services;

use App\Interfaces\DataServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class DbServices implements DataServiceInterface
{

    /**
     * @throws \Exception
     */
    public function create($model, $dto): Model
    {
        $data = [];
        foreach ($dto->toArray() as $field => $value) {
            $data[$field] = $value;
        }
        return $model::create($data)?:throw new Exception('Ошибка при работе с бд');
    }
}
