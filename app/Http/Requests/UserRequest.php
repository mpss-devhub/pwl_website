<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user_id'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|max:12|min:6',
            'status'=>'required',
            'permission_id'=>'required',
            "role" => 'required',
            'password'=>'required',
        ];
    }
}
