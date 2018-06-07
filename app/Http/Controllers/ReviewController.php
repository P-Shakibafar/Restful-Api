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
		 * Show the form for creating a new resource.
		 *
		 * @return void
		 */
		public function create()
		{
			//
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
		 * @param  \App\Model\Review $review
		 * @return void
		 */
		public function show(Review $review)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Model\Review $review
		 * @return void
		 */
		public function edit(Review $review)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Model\Review        $review
		 * @return void
		 */
		public function update(Request $request, Review $review)
		{
			//
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Model\Review $review
		 * @return void
		 */
		public function destroy(Review $review)
		{
			//
		}
	}
