<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "status" => "required",
            "merchant_name" => "required",
            "merchant_Cname" => "required",
            "merchant_Cphone" => "required",
            "merchant_Cemail" => "required",
            "merchant_frontendURL" => "nullable",
            "merchant_backendURL" => "nullable",
            "merchant_address" => "nullable",
            "merchant_notifyemail" => "required",
            "merchant_remark" => "nullable",
            "merchant_logo" => "required",
            "merchant_registration" => "nullable",
            "merchant_shareholder" => "nullable",
            "merchant_dica" => "nullable",
            'user_id' => "required",
            'password' => "required",
            'role' => "required",
        ];
    }
}
