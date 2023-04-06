<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'discount' => ['nullable', 'numeric'],
            'total' => ['required', 'max:255'],
            'payment_status' => ['required', 'max:255', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'order_status' => ['required', 'max:255', 'string'],
            'payment_proof' => ['file'],
        ];
    }
}
