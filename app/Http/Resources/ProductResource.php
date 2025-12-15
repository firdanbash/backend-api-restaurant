<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'sku'        => $this->sku,
            'name'       => $this->name,
            'stock'      => $this->stock,
            'price'      => $this->price,
            'image'      => $this->image,
            'image_url'  => $this->image ? asset('storage/products/' . $this->image) : null,
            'category_id' => $this->category_id,
            'category'   => new CategoryResource($this->whenLoaded('category')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
