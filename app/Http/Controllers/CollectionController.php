<?php

namespace App\Http\Controllers;

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

class CollectionController extends Controller
{
    use JsonRespondController;
    public function index(Request $request)
    {
        $collect = app(IndexCollection::class)->execute($request->all());
        return CollectResource::collection($collect);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            app(StoreCollection::class)->execute($request->all());
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
        try {
            $collect = app(ShowCollection::class)->execute([
                'id'=> $id
            ]);
            return new CollectResource($collect);
        }catch (ModelNotFoundException){
            return response([
                'error'=> 'collection not found'
            ], 404);
        }catch (ValidationException $e){
            return response([
                'errors'=> $e->validator->errors()->all()
            ], 422);
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
