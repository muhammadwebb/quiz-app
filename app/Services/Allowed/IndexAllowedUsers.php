<?php

namespace App\Services\Allowed;

use App\Models\Allowed_User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;

class IndexAllowedUsers extends BaseService
{
    public function rules(): array
    {
        return [ ];
    }

    public function execute(): Collection
    {
        return Allowed_User::all();
    }
}
