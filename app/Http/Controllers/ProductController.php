<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Resources\Product\ProductResource;
	use App\Model\Product;
	use Illuminate\Http\Request;
	
	class ProductController extends Controller {
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return \App\Model\Product[]|\Illuminate\Database\Eloquent\Collection
		 */
		public function index()
		{
			return Product ::all();
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return void
		 */
		public function store(Request $request)
		{
			//
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Model\Product $product
		 * @return \App\Http\Resources\Product\ProductResource
		 */
		public function show(Product $product): ProductResource
		{
			return new ProductResource($product);
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Model\Product       $product
		 * @return void
		 */
		public function update(Request $request, Product $product)
		{
			//
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Model\Product $product
		 * @return void
		 */
		public function destroy(Product $product)
		{
			//
		}
	}
