<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;


class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin');
    }

    public function saveQuestion(Request $request)
    {

        $content = json_decode($request->getContent(), true);
        $query = array();

        foreach($content as $question) {
            $question = array(
                'question_id' => $question['question_id'],
                'questionName' => $question['questionName'],
                'type' => $question['type'],
                'customOptions' => isset($question['customOptions']) ? json_encode($question['customOptions']) : '[]',
                'modifier' => isset($question['modifier']) ? $question['modifier'] : 1
            );
            array_push($query, $question);
        }

        DB::table('questions')->truncate();
        $response = DB::table('questions')->insert($query);

//        return Response()->json("Questions saved", 200);
        return Response()->json($response);
    }

}
