<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'message' => 'Success',
            'data' => [
                'meta' => [
                    'total' => $this->collection->count(),
                    'limit' => (int) $request->get('limit', 0),
                    'skip'  => (int) $request->get('skip', 0),
                ],
                'categories' => CategoryResource::collection($this->collection),
            ],
        ];
    }
}
