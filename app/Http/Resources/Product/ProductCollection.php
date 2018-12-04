<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'totalPrice' => round((100-$this->discount)/100*$this->price),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->avg('star')) : 'No rating',
            'discount' => $this->discount,
            'href' => [
                'product' => route('products.show',$this->id)
            ]
        ];
    }
}
