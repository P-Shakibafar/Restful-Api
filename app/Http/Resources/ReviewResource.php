<?php
	
	namespace App\Http\Resources;
	
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed customer
	 * @property mixed review
	 * @property mixed star
	 */
	class ReviewResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'customer' => $this -> customer,
					'body'     => $this -> review,
					'star'     => $this -> star,
			];
		}
	}
