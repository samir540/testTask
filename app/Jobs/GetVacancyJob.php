<?php

namespace App\Jobs;

use App\Models\Vacancy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GetVacancyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $responses = Http::get('https://api.recruitwizard.com/api/adverts/json/G6VY5GLxT62');
        $vacancies = json_decode($responses->body(), true);
        Vacancy::query()->truncate();

        foreach ($vacancies['Job'] as $vacancy) {

            Vacancy::create($vacancy);
//            DB::table('vacancies_crm')->insert([
//                'Title' => $vacancy['Title'],
//                'Expired' => $vacancy['Expired'],
//                'Summary' => $vacancy['Summary'],
//                'Description' => $vacancy['Description'],
//                'BulletPoints' => $vacancy['BulletPoints'],
//                'Salary' => $vacancy['Salary'],
//                'Classifications' => $vacancy['Classifications'],
//                'Apply' => $vacancy['Apply'],
//                'Reference' => $vacancy['Reference'],
//                'DatePosted' => $vacancy['DatePosted'],
//                'DateUpdated' => $vacancy['DateUpdated'],
//                'Recruiter' => $vacancy['Recruiter'],
//            ]);
        }

    }
}
