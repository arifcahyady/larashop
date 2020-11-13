<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
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
            'totalPrice' => round((1- ($this->discount/100)) * $this->price,2),
            'rating' => $this->reviews->count() == 0 ? 'Rating not yet' : round($this->reviews->sum('star')/$this->reviews->count(),1),
             'image' => $this->image,
            'href' => [
                'link' => route('products.show',$this->id)
            ]
        ];
    }
}
