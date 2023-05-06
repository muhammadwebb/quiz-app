<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ShowCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:collections,id'
        ];
    }

    /**
     * @throws ModelNotFoundException
     * @throws ValidationException
     */
    public function execute(array $data): array
    {
        $this->validate($data);
        $collection = Collection::findOrFail($data['id']);
        $question = $collection->questions;
        return [$collection, $question];
    }
}
