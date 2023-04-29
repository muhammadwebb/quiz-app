<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class UpdateCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'description'=> 'required|unique:collections,description',
            'name'=> 'required|unique:collections,name',
            'id'=> 'required|exists:collections,id',
        ];
    }

    /**
     * @throws ValidationException
     */

    public function execute(array $data): Collection
    {
        $this->validate($data);
        $collect = Collection::find($data['id']);
        $collect->update([
            'name'=> $data['name'],
            'description'=> $data['description']
        ]);
        return $collect;
    }
}
