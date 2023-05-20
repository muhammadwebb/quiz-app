<?php

namespace App\Services\Allowed;

use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class ShowAllowedUsers extends BaseService
{
    public function rules(): array
    {
        return [

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
