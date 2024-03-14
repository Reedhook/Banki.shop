<?php

namespace App\Dto;

use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageDto
{
    public string $name;
    public UploadedFile $image;

    public function __construct( UploadedFile $image)
    {
        $this->name = $image->getClientOriginalName();
        $this->image = $image;
    }

    public static function fromRequest(StoreRequest $request): static
    {
        return new static(
            $request->file('image'),
        );
    }

    public function toArray(): array
    {
        if($this->name != null){
           $data['name'] =  $this->name;
        }
        return $data;
    }

}
