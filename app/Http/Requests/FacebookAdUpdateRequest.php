<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacebookAdUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'content' => ['required', 'string'],
            'type' => ['required', 'max:255', 'string'],
            'status' => ['required', 'max:255', 'string'],
            'reach' => ['nullable', 'numeric'],
            'leads' => ['nullable', 'numeric'],
            'cost' => ['required', 'numeric'],
        ];
    }
}
