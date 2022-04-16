<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class JobController extends Controller
{
    public function getJobs()
    {
        $responses = Http::get('https://api.recruitwizard.com/api/adverts/json/G6VY5GLxT62');
        $vacancies = json_decode($responses->body(), true);
        $get_db = Vacancy::get()->toArray();
        Vacancy::query()->truncate();
        $data = [];

        foreach ($vacancies['Job'] as $vacancy) {
            Vacancy::create($vacancy);
        }

//        foreach ($vacancy['Job'] as $item)
//        {
//            //$data[] = $item;
//            echo $item['Title'];
//        }

       // dd($vacancy['Job'][0]['Title'], $get_db[0]['Title']);

//        echo "<pre>";
//            print_r($get_db);
//        echo "</pre>";

        //dd($data);

//        foreach ($data as $key => $val) {
//            echo $val['Title'];
//        }

       // Vacancy::create($responses);
//        dd($responses);
        //return VacancyResource::collection(Vacancy::get());
    }

    public function getVacancy()
    {
        return VacancyResource::collection(Vacancy::get());
    }
}
