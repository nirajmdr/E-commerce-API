<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
          'description' => $this->description,
          'price' => $this->price,
          'discount' => $this->discount,
          'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
          'totalPrice' => round((1-($this->discount/100)) * $this->price,2),

          'rating' => $this->review->count() > 0 ? round($this->review->sum('star')/$this->review->count())
          : 'No Ratings Yet',
          'href' => [
            'reviews' => route('reviews.index', $this->id)
          ]
        ];
    }
}
