<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Array_;


class IndexCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'search'=> 'nullable'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->validate($data);
        return Collection::with('user')->when($data['search'] ?? null, function ($query, $search){
            $query->search($search);
        })->paginate(10);
    }
}
