<?php

namespace App\Http\Controllers\ProFile;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerProFileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\EmployerProFile;
use Illuminate\Http\Request;

class EmployerProFileController extends Controller
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
        return UserResource::make($user->loadMissing([
            'employerProFile',
            'timesheets.employee',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployerProFileUpdateRequest $request)
    {
        $user = auth('sanctum')->user();
        $employerProFile = EmployerProFile::where('user_id', $user->id)->first();
        $employerProFile->update($request->validated());
        return UserResource::make($user->refresh()->loadMissing('employerProFile'));
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
