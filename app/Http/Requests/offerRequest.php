<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class offerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->getMethod() == Request::METHOD_POST)
            return [
                'photo' => 'image|mimes:jpeg,jpg,png,gif',
                'name_ar' => 'required|max:100|unique:offers,name_ar',
                'name_en' => 'required|max:100|unique:offers,name_en',
                'price' => 'required|numeric',
                'details_ar' => 'required',
                'details_en' => 'required',

            ];
        else if ($this->getMethod() == Request::METHOD_PUT)
            return [
                'photo' => 'image|mimes:jpeg,jpg,png,gif',
                'name_ar' => 'required|max:100|unique:offers,name_ar',
                'name_en' => 'required|max:100|unique:offers,name_en',
                'price' => 'required|numeric',
                'details_ar' => 'required',
                'details_en' => 'required',
            ];
    }

    public function messages()
    {
        return $messages = [
            'name_ar.required' => __('messages.offer_name_ar_required'),
            'name_ar.max' => __('messages.offer_name_ar_max'),
            'name_ar.unique' => __('messages.offer_name_ar_unique'),

            'name_en.required' => __('messages.offer_name_en_required'),
            'name_en.max' => __('messages.offer_name_en_max'),
            'name_en.unique' => __('messages.offer_name_en_unique'),


            'price.required' => __('messages.offer_price_required'),
            'price.numeric' => __('messages.offer_price_numeric'),

            'details_ar.required' => __('messages.offer_details_ar_required'),
            'details_en.required' => __('messages.offer_details_en_required'),
        ];
    }
}
