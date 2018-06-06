<?php
	/**
	 * Created by PhpStorm.
	 * User: ps
	 * Date: 6/6/18
	 * Time: 11:22 AM
	 */
	
	namespace App\Exceptions;
	
	use function dd;
	use Illuminate\Database\Eloquent\ModelNotFoundException;
	use function response;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
	
	trait ExceptionTrait {
		
		public function apiException($request, $e)
		{
//			dd($e);
			if($this -> isModel($e)) {
				return response() -> json([
						'errors' => 'Model not found',
				], Response::HTTP_NOT_FOUND);
			}
			if($this -> isHttp($e)) {
				return response() -> json([
						'errors' => 'Incorect route',
				], Response::HTTP_NOT_FOUND);
			}
			
			return parent ::render($request, $e);
		}
		
		public function isModel($e)
		{
			return $e instanceof ModelNotFoundException;
		}
		
		public function isHttp($e)
		{
			return $e instanceof NotFoundHttpException;
		}
	}