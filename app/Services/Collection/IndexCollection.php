<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection as TypeCollection;


class IndexCollection extends BaseService
{
    public function rules(): array
    {
        return [];
    }

    public function execute(array $data): TypeCollection
    {
        return Collection::all(['id', 'category_id', 'user_id', 'name', 'description', 'allowed_type', 'code', 'created_at', 'updated_at']);
    }
}
