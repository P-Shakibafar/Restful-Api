<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\ProductRequest;
	use App\Http\Resources\Product\ProductResource;
	use App\Http\Resources\Product\ProductCollection;
	use App\Model\Product;
	use Illuminate\Http\Request;
	use function response;
	use Symfony\Component\HttpFoundation\Response;
	use App\Exceptions\ProductNotBelongsToUser;
	use Auth;
	
	class ProductController extends Controller {
		
		public function __construct()
		{
			$this -> middleware('auth:api') -> except('index', 'show');
		}
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
		 */
		public function index()
		{
			return ProductCollection ::collection(Product ::paginate(5));
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Http\Requests\ProductRequest $request
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
		 */
		public function store(ProductRequest $request)
		{
			$product             = new Product;
			$product -> name     = $request -> name;
			$product -> details  = $request -> description;
			$product -> stock    = $request -> stock;
			$product -> price    = $request -> price;
			$product -> discount = $request -> discount;
			$product -> save();
			
			return response([
					'data' => new ProductResource($product),
			], Response::HTTP_CREATED);
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
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
		 * @throws \App\Exceptions\ProductNotBelongsToUser
		 */
		public function update(Request $request, Product $product)
		{
			$this -> ProductUserCheck($product);
			$request['details'] = $request -> description;
			unset($request['description']);
			$product -> update($request -> all());
			
			return response([
					'data' => new ProductResource($product),
			], Response::HTTP_CREATED);
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Model\Product $product
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
		 * @throws \Exception
		 */
		public function destroy(Product $product)
		{
			$this->ProductUserCheck($product);
			$product -> delete();
			
			return response([
					'data'=>'Product Deleted'
			], Response::HTTP_OK);
		}
		
		public function ProductUserCheck($product)
		{
			if(Auth ::id() !== $product -> user_id) {
				throw new ProductNotBelongsToUser;
			}
		}
	}
