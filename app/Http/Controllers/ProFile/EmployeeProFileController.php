<?php

namespace App\Http\Controllers\ProFile;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeProFileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\EmployeeProFile;
use Illuminate\Http\Request;

class EmployeeProFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth('sanctum')->user();
        return UserResource::make($user->loadMissing('employeeProFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeProFileUpdateRequest $request)
    {
        if ($request['step'] == 6 ) {
            $user = auth('sanctum')->user();
            $employeeProFile = EmployeeProFile::where('user_id', $user->id)->first();
            $employeeProFile->update($request->validated());
            return UserResource::make($user->refresh()->loadMissing('employeeProFile'));
        } else {
            return $request;
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
