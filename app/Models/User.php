<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Enums\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => Role::class
    ];

    public function employee()
    {
        return $this->belongsToMany(User::class, 'users' , 'employer_id' , 'id');
    }

    public function employer()
    {
        return $this->belongsToMany(User::class, 'users', 'employee_id', 'id');
    }

    public function employeeProFile()
    {
        return $this->hasOne(EmployeeProFile::class);
    }

    public function employerProfile()
    {
        return $this->hasOne(EmployerProFile::class);
    }

    public function timesheet()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function employers()
    {
        return $this->belongsToMany(User::class, 'employee_employer', 'employer_id');
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'employee_employer', 'employee_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $email = request('email');
        $url = env('APP_URL');
        $url = "$url/v1/api/reset-password?token=$token&email=$email";
        $this->notify(new ResetPasswordNotification($url));
    }



}
