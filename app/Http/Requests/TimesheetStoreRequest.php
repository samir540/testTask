<?php

namespace App\Http\Requests;

use App\Models\Timesheet;
use Illuminate\Foundation\Http\FormRequest;

class TimesheetStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch(request('enter_manual'))
        {
            case false:
                return $this->uploadDocument();
                break;
            default:
                return $this->enterManual();
                break;
        }
    }

    public function enterManual(): array
    {
        return [
            'employer_id' => 'required',
            'commencement_date' => 'required|date',
            'time_worked' => 'required|date_format:G:i',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'date_format:H:i|required_with:start_time',
            'comment' => 'string|nullable',
        ];
    }

    /**
     * @return string[]
     */
    public function uploadDocument(): array
    {
        return [
            'employer_id' => 'required',
            'commencement_date' => 'date|required',
            'comment' => 'string|nullable',
            'file' => 'required|mimes:doc,pdf,txt,csv,xlsx,docx,jpeg,jpg,png|file|max:102400',
        ];
    }
}
