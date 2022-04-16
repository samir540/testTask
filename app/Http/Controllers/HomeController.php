<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Http\Resources\UserResource;
use App\Mail\ContactUs;
use App\Mail\ContactUsAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function contactUsMail(ContactUsRequest $request)
    {

        if(auth('sanctum')->user()) {
            Mail::to(config('app.adminEmail'))->send(new ContactUsAuth($request));
            return response('success', 200);
        } else {
            Mail::to(config('app.adminEmail'))->send(new ContactUs($request));
            return response('success', 200);
        }
    }

    public function me()
    {
        return UserResource::make(auth('sanctum')->user());
    }
}
