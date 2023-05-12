<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collect\CollectionCollection;
use App\Http\Resources\Collect\CollectionWithQuestionsResource;
use App\Http\Resources\Collect\CollectResource;
use App\Services\Collection\DestroyCollection;
use App\Services\Collection\IndexCollection;
use App\Services\Collection\ShowCollection;
use App\Services\Collection\StoreCollection;
use App\Services\Collection\UpdateCollection;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class CollectionController extends Controller
{
    use JsonRespondController;

    public function index(Request $request)
    {
        $collect = app(IndexCollection::class)->execute($request->all());
        return new CollectionCollection($collect);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            app(StoreCollection::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }


    public function show(string $id)
    {
        try {
            [$collection, $questions] = app(ShowCollection::class)->execute([
                'id'=> $id
            ]);
            return (new CollectionWithQuestionsResource($collection))->setQuestions($questions);
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }catch (ModelNotFoundException){
            return $this->respondNotFound();
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $collect = app(UpdateCollection::class)->execute([
                'id'=> $id,
                'name'=> $request->name,
                'description'=> $request->description
            ]);
            return new CollectResource($collect);
        }catch (ValidationException $e){
            return response([
                'errors'=> $e->validator->errors()->all()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):string
    {
        try {
            $collect = app(DestroyCollection::class)->execute([
                'id'=> $id
            ]);
            return response([
                'successful'=> true
            ]);
        }catch (ValidationException $e){
            return response([
                'errors'=> $e->validator->errors()->all()
            ], 422);
        }
    }
}
