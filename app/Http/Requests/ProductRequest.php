<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 * @property mixed discount
 * @property mixed price
 * @property mixed stock
 * @property mixed description
 */
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:products|max:255',
            'description'=>'required',
            'price'=>'required|max:10',
            'stock'=>'required|max:6',
            'discount'=>'required|max:2',
        ];
    }
}
