<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'stock' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'product' => 'required|array',
            "product.*.title" => 'required|string',
            "product.*.wine_name" => 'required|string',
            "product.*.region_id" => 'required',
            "product.*.producer_id" => 'required',
            "product.*.type_of_wine" => 'required',
            "product.*.wine_tag_id" => 'required',
            "product.*.basket_quantity" => 'required',
            "product.*.unit_quantity" => 'required',
            "product.*.unit" => 'required',

        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
