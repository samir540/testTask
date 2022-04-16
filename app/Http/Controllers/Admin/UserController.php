<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Mail\CreateUser;
use App\Models\EmployeeProFile;
use App\Models\EmployerProFile;
use App\Models\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::where('role','!=', Role::ADMINISTRATOR)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make(request('password'));

        if($data['role'] === 'employee') {

            $data['name'] = $data['first_name']." ".$data['surname'];
            $user = User::create($data);

            EmployeeProFile::create([
                'user_id' => $user->id,
                'account_num' => $user->id,
                'email' => $user->email,
                'first_name' => $data['first_name'],
                'surname' => $data['surname'],
            ]);

            Mail::to(config('app.adminEmail'))->send(new CreateUser($request));
            return UserResource::make($user->loadMissing('employeeProFile'));

        } else if($data['role'] === 'employer') {

            $user = User::create($data);
            EmployerProFile::create([
                'user_id' => $user->id,
                'company_name' => $data['name'],
                'key_hiring' => $data['key_hiring'],
                'phone_num_hiring' => $data['phone_num_hiring'],
                'email_hiring' => $data['email_hiring'],
                'key_accounts' => $data['key_accounts'],
                'phone_num_account' => $data['phone_num_account'],
                'email' => $user->email,
                'add_inform' => $data['add_inform']

            ]);

            Mail::to(config('app.adminEmail'))->send(new CreateUser($request));
            return UserResource::make($user->loadMissing('employerProFile'));

        } else {
            return response("User not creat");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return UserResource::make($user->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response('User delete success', 200);
    }
}
