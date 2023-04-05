<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDetailsUpdateRequest extends FormRequest
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
            'customer_id' => ['required', 'exists:customers,id'],
            'businuss_name' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'number' => ['nullable', 'numeric'],
            'address' => ['nullable', 'max:255', 'string'],
            'about' => ['max:255', 'string'],
            'qoutation' => ['file', 'max:1024', 'required'],
        ];
    }
}
