<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
	 * @property mixed reviews
	 * @property mixed name
	 * @property mixed details
	 * @property mixed stock
	 * @property mixed price
	 * @property mixed discount
	 */
	class Product extends Model {
		
		protected $fillable = [
				'name', 'details', 'stock', 'price', 'discount',
		];
		
		public function reviews()
		{
			return $this -> hasMany(Review::class);
		}
	}
