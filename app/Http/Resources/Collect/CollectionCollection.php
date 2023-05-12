<?php

namespace App\Http\Resources\Collect;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @method total()
 * @method perPage()
 * @method currentPage()
 * @method lastPage()
 */

class CollectionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                    'data' => $this->collection,
                    'pagination' => [
                        'total' => $this->total(),
                        'count' => $this->count(),
                        'per_page' => $this->perPage(),
                        'current_page' => $this->currentPage(),
                        'total_pages' => $this->lastPage()
                    ],
                ];
    }

    public function withResponse($request, $response)
        {
            $jsonResponse = json_decode($response->getContent(), true);
            unset($jsonResponse['links'], $jsonResponse['meta']);
            $response->setContent(json_encode($jsonResponse));
        }
}
