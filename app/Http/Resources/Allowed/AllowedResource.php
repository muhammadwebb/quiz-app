<?php

namespace App\Http\Resources\Allowed;

use App\Http\Resources\Collect\CollectResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllowedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'allowed_user'=> new UserResource($this->user),
            'collection' => new CollectResource($this->name)
        ];
    }
}
