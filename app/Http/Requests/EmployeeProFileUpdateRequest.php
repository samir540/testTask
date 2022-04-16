<?php

namespace App\Http\Requests;

use App\Models\Enums\Role;
use App\Models\User;
use Faker\Provider\Lorem;
use GuzzleHttp\Psr7\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\RequestStack;

class EmployeeProFileUpdateRequest extends FormRequest
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

        switch(request('step')){
            case 1:
                return $this->personalDetails();
                break;
            case 2:
                return $this->contactDetails();
                break;
            case 3:
                return $this->emergenyContacts();
                break;
            case 4:
                return $this->financialDetails();
                break;
            case 5:
                return $this->employmentDetails();
                break;
            case 6:
                return $this->allRules();
                break;
            default :
                return [];
                break;

        }
    }

    public function personalDetails()
    {
        return [
           'user_id' => 'required|integer|exists:users,id',
           'first_name' => 'string|nullable',
           'middle_name' => 'string|nullable',
           'surname' => 'string|nullable',
           'birthday' => 'date|nullable',
           'residancy_status' => 'string|nullable',
        ];
    }

    public function contactDetails()
    {
        return [
            'residental_address' => 'string|nullable',
            'home_tel' => 'string|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'mobile_tel' => 'string|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'postal_address' => 'string|nullable',
        ];
    }

    public function emergenyContacts()
    {
        return [
            'cont1_relationship' => 'string|nullable',
            'cont1_home_tel' => 'string|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'cont1_mobile_tel' => 'string|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'cont1_address' => 'string|nullable',
            'cont2_relationship' => 'string|nullable',
            'cont2_home_tel' => 'string|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'cont2_mobile_tel' => 'string|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'cont2_address' => 'string|nullable',
        ];
    }

    public function financialDetails()
    {
        return [
            'bank_name' => 'string|nullable',
            'branch' => 'string|nullable',
            'account_name' => 'string|nullable',
            'bsb' => 'string|nullable',
//            'account_num' => ['string', 'nullable', Rule::unique('employee_pro_files','account_num')->ignore($this->id)],
            'account_num' => 'string|nullable',
            'company_abn' => 'numeric|nullable',
            'threshold' => 'boolean',
            'super_fund_name' => 'string|nullable',
            'bsb_super_fund' => 'string|nullable',
            'fund_account_num' => 'string|nullable',
            'bpay_biller_code' => 'numeric|nullable|min:1|max:9999',
            'reference_num' => 'string|nullable',
        ];
    }

    public function employmentDetails()
    {
        return [
            'start_date' => 'date',
            'client' => 'string|nullable',
            'position' => 'string|nullable',
            'location' => 'string|nullable',
            'notes' => 'string|nullable',
        ];
    }

    public function allRules()
    {
        return array_merge(
            $this->personalDetails(),
            $this->contactDetails(),
            $this->emergenyContacts(),
            $this->financialDetails(),
            $this->employmentDetails()
        );
    }

    protected function prepareForValidation()
    {
        $this->merge([
           'user_id' => request('user_id') ?? (auth('sanctum')->user()->role == Role::EMPLOYEE ? auth('sanctum')->id() : null)
        ]);
    }
}
