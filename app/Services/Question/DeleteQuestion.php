<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DeleteQuestion extends BaseService
{
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:questions,id'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): string
    {
        $this->validate($data);
        $question = Question::find($data['id']);
//          dd($answers);
        $question->delete();
        DB::table('answers')->where('question_id', $question->id)->delete();
        return true;
    }
}
