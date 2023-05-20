<?php

namespace App\Http\Controllers;

use App\Http\Resources\Allowed\AllowedCollection;
use App\Http\Resources\Allowed\AllowedResource;
use App\Services\Allowed\IndexAllowedUsers;
use App\Services\Allowed\StoreAllowedUsers;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class AllowedController extends Controller
{
    use JsonRespondController;

    public function index(): JsonResource|JsonResponse
    {
       $allowed = app(IndexAllowedUsers::class)->execute();
       return AllowedResource::collection($allowed);
    }

    public function store(Request $request, string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
