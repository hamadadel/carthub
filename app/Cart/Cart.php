<?php

namespace App\Cart;

use App\Models\User;

class Cart
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function add($products)
    {
        $products = $this->getRequestPayloadAndRestructure($products);
        $this->user->cart()->syncWithoutDetaching($products);
    }



    private function getRequestPayloadAndRestructure($requestPayload)
    {
        return collect($requestPayload)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])
            ];
        })->toArray();
    }



    private function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart->where('id', $productId)->first())
            return $product->pivot->quantity;
        return 0;
    }
}
