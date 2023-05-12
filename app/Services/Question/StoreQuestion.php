<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StoreQuestion extends BaseService
{
    private array $answers;
    public function rules(): array
    {
        return [
            'collection_id'=> 'required',
            'question'=> 'required',
            'answers'=> 'nullable|array',
            'answers.*.answer'=> 'required_unless:answers,null',
            'answers.*.is_correct'=> 'required_unless:answers,null'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): string
    {
        $this->validate($data);

        $answers = collect($data['answers']);
        $question = Question::create([
            'collection_id'=> $data['collection_id'],
            'question'=> $data['question'],
            'correct_answers'=> $answers->where('is_correct', true)->count()
        ]);

        foreach ($data['answers'] as $answer){
            $this->answers [] = [
                'question_id'=> $question->id,
                'answer'=> $answer['answer'],
                'is_correct'=> $answer['is_correct'],
            ];
        }
        DB::table('answers')->insert($this->answers);
        $this->answers = [];

        return $question;
    }
}
