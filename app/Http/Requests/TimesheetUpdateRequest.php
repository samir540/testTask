<?php

namespace App\Http\Requests;

use App\Models\Timesheet;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\True_;

class TimesheetUpdateRequest extends FormRequest
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

    public function enterManual()
    {
        return [
            'commencement_date' => 'required|date',
            'time_worked' => 'required|date_format:G:i',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'date_format:H:i|required_with:start_time',
            'comment' => 'string|nullable',
        ];
    }

    public function uploadDocument()
    {
        return [
            'commencement_date' => 'date|required',
            'comment' => 'string|nullable',
            'file' => 'required|mimes:doc,pdf,txt,csv,xlsx,docx,jpeg,jpg,png|file|max:102400',
        ];
    }
}
