<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkUpdateRequest extends FormRequest
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
            "user_id"=> "required",
            "invoiceNo"=> "required|unique:links,link_invoiceNo",
            "amount"=> "required",
            "name"=> "required|max:100",
            "phone"=> "required",
            "email"=> "nullable|email",
            "expired_at"=> "required",
            'description'=>"nullable|max:70",
            'notification'=>'required',
            'currency'=>'required'

        ];
    }
}
