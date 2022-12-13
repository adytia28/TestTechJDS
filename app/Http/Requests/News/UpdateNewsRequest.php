<?php

namespace App\Http\Requests\News;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateNewsRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request) {
        return [
            'news_category_id'  => 'required|exists:news_categories,id',
            'title'     => 'required',
            'content'   => 'required',
            'thumbnail'    => gettype($request->file('thumbnail')) == 'object' ? 'image|mimes:jpg,png|max:200' :  'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
