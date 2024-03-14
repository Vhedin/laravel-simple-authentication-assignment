<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'name'                => 'required|string|max:255',
            'email'               => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            'password'            => 'nullable|string|min:8|confirmed',
            'avatar'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'addresses'           => 'required|array',
            'addresses.*.country' => 'required|string|max:255',
            'addresses.*.city'    => 'required|string|max:255',
            'addresses.*.address' => 'required|string|max:255',
        ];
    }
}
