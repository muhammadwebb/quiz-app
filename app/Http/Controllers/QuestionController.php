<?php

namespace App\Http\Controllers;

use App\Services\Question\DeleteQuestion;
use App\Services\Question\StoreQuestion;
use App\Services\Question\UpdateQuestion;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    use JsonRespondController;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        try {
            $question = app(StoreQuestion::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):string
    {
        try {
            app(UpdateQuestion::class)->execute([
                'id'=> $id,
                'question'=> $request->question,
                'answers'=>$request->answers
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        try {
            app(DeleteQuestion::class)->execute([
                'id'=> $id
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}
