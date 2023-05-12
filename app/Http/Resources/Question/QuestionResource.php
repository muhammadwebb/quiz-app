<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Collect\CollectionCollection;
use App\Http\Resources\Collect\CollectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'collection_id'=> CollectResource::collection($this->id),
            'question'=> $this->question,
            'correct_answers'=> $this->correct_answers,
            'answers'=> AnswerResource::collection($this->answers),
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
