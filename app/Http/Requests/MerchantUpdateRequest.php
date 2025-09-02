<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantUpdateRequest extends FormRequest
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
           "merchant_name"=>"required|string|max:255",
           "merchant_id" => "required",
            "merchant_Cname" => "required|string|max:255",
            "merchant_Cphone" => "required|digits_between:4,12",
            "merchant_Cemail" => "required|email",
            "merchant_frontendURL" => "nullable|url",
            "merchant_address" => "nullable",
            "merchant_notifyemail" => "required",
            "merchant_remark" => "nullable",
            "merchant_logo" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "merchant_registration" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "merchant_shareholder" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            "merchant_dica" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:2048",
            'user_id' => "required",

        ];
    }
}
