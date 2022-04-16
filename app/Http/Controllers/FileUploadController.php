<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimesheetStoreRequest;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        if($file = $request->file('file'))
        {
            $path = $file->store('public/files');
            $name_file = $file->getClientOriginalName();

            return [
                'path' => $path,
                'name_file' => $name_file,
            ];
        } else {
            return [];
        }
    }
}
