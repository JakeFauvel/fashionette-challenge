<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'q' => 'bail|required|string'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse
     *
     */
    protected function failedValidation(Validator $validator)
    {
        return throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Failed request, invalid query paramter',
                'suggestion' => 'This request expects a single query parameter (q). For example http://0.0.0.0/api/search?q=example',
                'code' => 1
            ], 400)
        );
    }
}
