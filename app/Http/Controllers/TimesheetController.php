<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimesheetStoreRequest;
use App\Http\Requests\TimesheetUpdateRequest;
use App\Http\Resources\TimesheetResource;
use App\Http\Resources\UserResource;
use App\Jobs\TimesheetJob;
use App\Mail\AdminTimesheet;
use App\Models\Enums\Role;
use App\Models\Timesheet;
use App\Models\User;
use App\Notifications\AcceptTimesheet;
use App\Notifications\TimeSheetNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class TimesheetController extends Controller
{
    use Notifiable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TimesheetResource::collection(Timesheet::whereUserId(auth('sanctum')->id())->get()
            ->loadMissing('employer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TimesheetResource
     */
    public function store(TimesheetStoreRequest $request)
    {
        $data = $request->validated();
        $user = auth('sanctum')->user();
        if ($request->file('file')) {
            $fileUpload = new FileUploadController();
            $fileStore = $fileUpload->upload($request);
            $data['name_file'] = $fileStore['name_file'];
            $data['path'] = $fileStore['path'];
        }
        $data['user_id'] = $user->id;
        $timesheet = Timesheet::create($data);
        $data['email'] = $user->email;
       // $timesheet->notify(new TimeSheetNotification($data));
       //Notification::send(env('MAIL_ADMIN_ADDRESS'),new TimeSheetNotification($data));
        $job = new TimesheetJob($data);
        $this->dispatch($job);
       // dd($data);
        // Письмо через нотификации
        // $data['email'] = $user->email;
        // Mail::to(env('MAIL_ADMIN_ADDRESS'))->send(new AdminTimesheet($data));
        return TimesheetResource::make($timesheet);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return TimesheetResource
     */
    public function show($id)
    {
        $timeSheet = Timesheet::findOrFail($id);
        return TimesheetResource::make($timeSheet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(TimesheetUpdateRequest $request, Timesheet $timesheet): UserResource
    {
        $this->authorize('update', $timesheet);
        $fileUpload = new FileUploadController();
        $data = $request->validated();
        if ($fileUpload->upload($request)) {
            $fileStore = $fileUpload->upload($request);
            Storage::delete($timesheet->path);
            $data['name_file'] = $fileStore['name_file'];
            $data['path'] = $fileStore['path'];
        }
        $timesheet->update($data);
        return UserResource::make($timesheet->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
       if(auth('sanctum')->user() === Role::ADMINISTRATOR) {
           if ($timesheet->path) Storage::delete($timesheet->path);
           $timesheet->delete();
           return response('Timesheet delete success', 200);
       } else {
           return response('You do not have permission to delete');
       }
    }

    public function accept(Timesheet $timesheet)
    {
        $timesheet->update([
            'accept' => true
        ]);
        return $this->dataForNotification($timesheet);
    }

    public function reject(Timesheet $timesheet)
    {
        $timesheet->update([
            'reject' => true
        ]);

        return $this->dataForNotification($timesheet);
    }

    /**
     * @param Timesheet $timesheet
     * @return Timesheet
     */
    public function dataForNotification(Timesheet $timesheet): Timesheet
    {
        $employee = DB::table('users')->find($timesheet->user_id);
        $employer = DB::table('users')->find($timesheet->employer_id);
        $data['employee_email'] = $employee->email;
        $data['employer_email'] = $employer->email;
        $data['commencement_date'] = $timesheet->commencement_date;
        Notification::route('mail', env('MAIL_ADMIN_ADDRESS'))->notify(new AcceptTimesheet($data));
        return $timesheet;
    }
}
