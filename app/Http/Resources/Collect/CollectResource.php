<?php

namespace App\Http\Resources\Collect;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category_id'=> $this->category_id,
            'user_id'=> $this->user_id,
            'name'=> $this->name,
            'description'=> $this->description,
            'allowed_type'=> $this->allowed_type,
            'code' => $this->code,
            'created_at'=> $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'=> $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
