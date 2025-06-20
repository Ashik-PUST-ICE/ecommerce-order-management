<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
public function rules(): array
{
    return [
        'outlet_id' => 'required|exists:outlets,id',
        'payment_method' => 'required|in:cash,card,transfer',
        'shipping_address' => 'required|string|max:255'
    ];
}


    /**
     * Get the validated data from the request.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return array
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        // Set default payment method if not provided
        if (!isset($validated['payment_method'])) {
            $validated['payment_method'] = 'cash';
        }

        return $validated;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'outlet_id.required' => 'Please select an outlet for your order.',
            'outlet_id.exists' => 'The selected outlet is invalid.',
            'payment_method.in' => 'The selected payment method is invalid.',
            'shipping_address.max' => 'The shipping address may not be longer than 500 characters.',
        ];
    }
}
