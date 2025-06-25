<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            //
            "user_id"=> "required",
            "invoiceNo"=> "required|unique:links,link_invoiceNo",
            "amount"=> "required",
            "name"=> "required",
            "phone"=> "required",
            "email"=> "nullable",
            "expired_at"=> "required",
            'description'=>"nullable",
            'notification'=>'required',
            'currency'=>'required'

        ];
    }
}
