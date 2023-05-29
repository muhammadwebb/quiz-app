<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateQuestion extends BaseService
{
    private array $answers;

    public function rules(): array
    {
        return [
            'id'=> 'required|exists:questions,id',
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
        $question = Question::find($data['id']);
        $oldAnswers = $question->answers->pluck('answer');
        $question->update([
            'question'=> $data['question'],
            'correct_answers'=> $answers->where('is_correct', true)->count()
        ]);

        foreach ($answers as $answer){
            if (!in_array($answer['answer'], $oldAnswers)){
                $this->answers [] = [
                    'question_id'=> $question->id,
                    'answer'=> $answer['answer'],
                    'is_correct'=> $answer['is_correct'],
                ];
            }
        }
        if (!empty($this->answers)){
            DB::table('answers')->insert($this->answers);
        }
        $this->answers = [];
        return true;

    }
}
