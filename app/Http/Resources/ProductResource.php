<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->variations->groupBy('type.name'));
        // return parent::toArray($request);
        return array_merge(parent::toArray($request), [
            'variations' => ProductVariationResource::collection(
                $this->variations->groupBy('type.name')
            ),
        ]);
    }
}
