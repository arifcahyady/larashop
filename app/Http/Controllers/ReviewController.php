<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use App\Model\Review;
use App\Model\Product;

class ReviewController extends Controller
{
    public function index(Product $product)
    {
    	return ReviewResource::collection($product->reviews);
    }

    public function store(ReviewRequest $request, Product $product)
    {
    	$review = new Review($request->all());

    	$product->reviews()->save($review);

    	return response()->json([
    		'data' => new ReviewResource($review)
    	], 201);
    }

    public function update(Request $request,Product $product,Review $review)
    {
        $review->update($request->all());

        return response()->json([
            'data' => new ReviewResource($review)
        ], 201);
    }
}
