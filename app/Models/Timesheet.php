<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'accept' => 'boolean',
        'reject' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class,'employer_id', 'id');
    }
}
