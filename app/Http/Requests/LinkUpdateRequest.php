<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $linkId = $this->route('id'); // get the {id} from route
        //dd($linkId);
        return [
            "user_id"    => "required",
            "invoiceNo"  => [
                "required",
                Rule::unique('links', 'link_invoiceNo')->ignore($linkId,'id'),
            ],
            "amount"     => "required",
            "name"       => "required|max:100",
            "phone"      => "required",
            "email"      => "nullable|email",
            "expired_at" => "required",
            "description" => "nullable|max:90",
            "notification" => "required",
            "currency"   => "required"
        ];
    }
}
