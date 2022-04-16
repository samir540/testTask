<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        

        switch(request('role')) {
            case 'employee': 
                return $this->employeeValidation();
                break;
            case 'employer': 
                return $this->employerValidation();
                break;
            default;
                return [];
                break;

        }
    }

    public function employeeValidation()
    {
        return [
            'first_name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required'],
        ];
    }

    public function employerValidation()
    {
        return [
            'name' => ['string'],
            'key_hiring' => ['string'],
            'phone_num_hiring' => ['string','regex:/^([0-9\s\-\+\(\)]*)$/','min:12'],
            'email_hiring' => 'email',
            'key_accounts' => ['string'],
            'phone_num_account' => ['string','regex:/^([0-9\s\-\+\(\)]*)$/','min:12'],
            'email' => ['email', 'required'],
            'add_inform' => ['string'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role'=> ['required'],
        ];
    }
}
