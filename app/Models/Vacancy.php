<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $casts = [
        'Expired' => 'boolean',
        'BulletPoints' => AsArrayObject::class,
        'Salary' => AsArrayObject::class,
        'Classifications' => AsCollection::class,
        'Apply' => AsArrayObject::class,

    ];


    protected $guarded = ['id'];

    protected $table = 'vacancies_crm';

}
