<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Resources\ReviewResource;
	use App\Http\Requests\ReviewRequest;
	use App\Model\Product;
	use App\Model\Review;
	use Illuminate\Http\Request;
	use function response;
	use Symfony\Component\HttpFoundation\Response;
	
	class ReviewController extends Controller {
		
		/**
		 * Display a listing of the resource.
		 *
		 * @param \App\Model\Product $product
		 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
		 */
		public function index(Product $product)
		{
			return ReviewResource ::collection($product -> reviews);
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Http\Requests\ReviewRequest $request
		 * @param \App\Model\Product               $product
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
		 */
		public function store(ReviewRequest $request, Product $product)
		{
			$review = new Review($request -> all());
			$product -> reviews() -> save($review);
			
			return response([
					'data' => new ReviewResource($review),
			], Response::HTTP_CREATED);
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param \App\Model\Product $product
		 * @param  \App\Model\Review $review
		 * @return \App\Http\Resources\ReviewResource
		 */
		public function show(Product $product,Review $review): ReviewResource
		{
			return new ReviewResource($product->reviews()->find($review->id));
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param \App\Model\Product        $product
		 * @param  \App\Model\Review        $review
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
		 */
		public function update(Request $request, Product $product, Review $review)
		{
			$review -> update($request -> all());
			
			return response([
					'data' => new ReviewResource($review),
			], Response::HTTP_CREATED);
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Model\Product $product
		 * @param  \App\Model\Review $review
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
		 * @throws \Exception
		 */
		public function destroy(Product $product, Review $review)
		{
			$review -> delete();
			
			return response([
					'data' => 'Review Deleted',
			], Response::HTTP_OK);
		}
	}
