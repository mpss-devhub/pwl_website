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
            "user_id" => "required",
            "invoiceNo" => "required|unique:links,link_invoiceNo|max:25",
            "amount" => "required",
            "name" => "required|max:100",
            "phone" => "required|digits_between:1,16",
            "email" => "nullable|email|max:30",
            "expired_at" => "required|date|after_or_equal:today",
            'description' => "nullable|max:200",
            'notification' => 'required',
            "currency" => "required|in:MMK,USD",


        ];
    }
}
