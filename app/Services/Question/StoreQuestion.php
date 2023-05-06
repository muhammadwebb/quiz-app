<?php

namespace App\Services\Question;

use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class StoreQuestion extends BaseService
{
    public function rules(): array
    {
        return [
            'collection_id'=> 'required',
            'question'=> 'required'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): string
    {
        return $this->validate($data);
    }
}
