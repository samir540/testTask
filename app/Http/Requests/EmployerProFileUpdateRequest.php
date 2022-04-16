<?php

namespace App\Http\Requests;

use App\Models\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;

class EmployerProFileUpdateRequest extends FormRequest
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
        return [
            'user_id' => 'required|integer|exists:users,id',
            'company_name' => 'string',
            'key_hiring' => 'string',
            'phone_num_hiring' => 'string|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'email_hiring' => 'email',
            'key_accounts' => 'string',
            'phone_num_account' => 'string|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'add_inform' => 'string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
           'user_id' => request('user_id') ?? (auth('sanctum')->user()->role == Role::EMPLOYER ? auth('sanctum')->id() : null)
        ]);
    }
}
