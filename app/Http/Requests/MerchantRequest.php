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
            "merchant_name" => "required|unique:merchants,merchant_name",
            "merchant_Cname" => "required|max:255|unique:merchants,merchant_Cname",
            "merchant_Cphone" => "required|unique:merchants,merchant_Cphone|unique:users,phone",
            "merchant_Cemail" => "required|unique:merchants,merchant_Cemail|unique:users,email",
            "merchant_frontendURL" => "nullable|max:255",
            "merchant_address" => "nullable|max:255",
            "merchant_notifyemail" => "required|unique:merchants,merchant_notifyemail",
            "merchant_remark" => "nullable|max:255",
            "merchant_logo" => "required",
            "merchant_registration" => "nullable",
            "merchant_shareholder" => "nullable",
            "merchant_dica" => "nullable",
            'user_id' => "required:unique:users,user_id",
            'password' => "required",
            'role' => "required",
        ];
    }
}
