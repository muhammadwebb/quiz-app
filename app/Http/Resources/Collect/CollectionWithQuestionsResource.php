<?php

namespace App\Http\Resources\Collect;

use App\Http\Resources\Question\QuestionResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionWithQuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    private $questions;
    public function setQuestions($questions): static
    {
        $this->questions = $questions;
        return $this;
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'allowed_type' => $this->allowed_type,
            'questions' => QuestionResource::collection($this->questions),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
