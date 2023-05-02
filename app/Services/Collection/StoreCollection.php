<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StoreCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'category_id'=> 'required',
            'user_id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'allowed_type'=> 'required_with:url,public',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): Collection
    {
        $this->validate($data);
        return Collection::create(array_merge($data, [
            'code'=> Str::random(10)
        ]));
    }
}
