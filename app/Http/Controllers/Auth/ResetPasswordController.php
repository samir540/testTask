<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
  public function resetPassword(ResetPasswordRequest $request)
  {
    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => Hash::make($password)
        ])->createToken('auth-token');

        $user->save();

        event(new PasswordReset($user));
      }
    );

      if($status == Password::PASSWORD_RESET){
          $message = "Password reset successfully";
      }else{
          $message = "Email could not be sent to this email address";
      }
      $status = ['data'=>'','message' => $message];
      return response()->json($status);
  }

}
