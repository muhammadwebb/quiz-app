<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StoreCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'category_id'=> 'required|exists:categories,id',
            'name'=> 'required',
            'description'=> 'required',
            'allowed_type'=> 'required_with:url,public',
            'questions'=> 'nullable|array',
            'questions.*.question'=> 'required_unless:questions,null',
            'questions.*.answers'=> 'required_unless:questions,null',
            'questions.*.answers.*.answer'=> 'required_unless:questions,null',
            'questions.*.answers.*.is_correct'=> 'required_unless:questions,null|boolean',
            'allowed_users'=> 'required_unless:allowed_type,public,url|array'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): bool
    {
        $this->validate($data);
        $collection = Collection::create([
            'category_id' => $data['category_id'],
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'description' => $data['description'],
            'code' => Str::uuid(),
            'allowed_type' => $data['allowed_type'],
        ]);

        foreach ($data['questions'] as $question) {
            $answers = collect($question['answers']);
            $question = Question::create([
                'collection_id'=> $collection->id,
                'question'=> $question['question'],
                'correct_answers'=> $answers->where('is_correct', true)->count()
            ]);

            foreach ($answers as $answer) {
                $this->answers[] =[
                  'question_id'=> $question->id,
                  'answer'=> $answer['answer'],
                    'is_correct'=> $answer['is_correct']
                ];
            }

            DB::table('answers')->insert($this->answers);
            $this->answers = [];
        }

        return true;
    }
}
