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
        $merchantId = $this->route('id');
        return [
            'status' => 'required',
            'merchant_name' => 'required|string|max:255',
            'merchant_id' => 'required',
            'merchant_Cname' => 'required|string|max:255',
            'merchant_Cphone' => "required|digits_between:4,12|unique:merchants,merchant_Cphone,{$merchantId},user_id",
            'merchant_Cemail' => "required|email|unique:merchants,merchant_Cemail,{$merchantId},user_id",
            'merchant_frontendURL' => 'nullable|url|max:255',
            'merchant_address' => 'nullable|max:255',
            'merchant_notifyemail' => 'required',
            'merchant_remark' => 'nullable|max:255',
            'merchant_logo' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'merchant_registration' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'merchant_shareholder' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'merchant_dica' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'user_id' => 'required',
        ];
    }
}
