<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderTakeRequest extends FormRequest
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
        return [
            'status' => 'required|in:TAKEN'
        ];
    }

    public function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json([
            'error' => 'VALIDATION_ERRORS',
            'error_detail' => $validator->errors()
        ], 422));
    }
}
