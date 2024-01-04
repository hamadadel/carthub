<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        /**
         * When grouping this items each of them
         * groups will be an individual collection
         * with items inside of themselves
         */
        if ($this->resource instanceof Collection)
            return ProductVariationResource::collection($this->resource);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->formattedPrice,
            'price_varies' => $this->priceVaries(),
        ];
    }
}
