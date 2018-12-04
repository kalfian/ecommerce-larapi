<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock != 0 ? $this->stock : 'Out of Stock',
            'totalPrice' => round((100-$this->discount)/100*$this->price),
            'discount' => $this->discount,
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->avg('star')) : 'No rating',
            'href' => [
                'reviews' => route('reviews.index',$this->id)
            ]
        ];
    }
}
