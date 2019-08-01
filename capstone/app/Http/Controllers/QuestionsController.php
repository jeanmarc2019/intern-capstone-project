<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class QuestionsController extends BaseController
{

//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public static function getQuestion()
    {
        $response = DB::select('select * from questions');

        return json_encode($response);
    }
}
