<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\ProductRequest;
use App\Model\Product;


class ProductController extends Controller
{
    public function index()
    {
    	return ProductCollection::collection(Product::paginate(30));
    }

    public function show(Product $product)
    {


    	return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
    	$product = new Product;

    	$product->name = $request->name;
    	$product->detail = $request->description;
    	$product->stock = $request->stock;
    	$product->price = $request->price;
    	$product->discount = $request->discount;
         if ($request->hasFile('image')) {
            // $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            // $product->image = $request->file('image')->getClientOriginalName();

            $image = base64_encode(file_get_contents($request->file('image')));
            $product->image = 'uri:' . $image;
            // dd($image);
    	   }
        $product->save();

    	return response()->json([
    		'data' => new ProductResource($product)
    	], 201);
    }

    public function update(Request $request, Product $product)
    {
      
    	$request['detail'] = $request->description;
    	unset($request['description']);
          // dd($request->all());
        // $product = Product::find('id');
    	$product->update($request->all());

    	return response()->json([
    		'data' => new ProductResource($product)
    	], 201);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'User has been deleted'
        ], 200);
    }

    
    
}
