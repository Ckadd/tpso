<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Poll;
use App\Model\PollQuestion;

class ReportPollController extends Controller
{
    public function listPoll(){
        $polls = Poll::orderBy('name','asc')->paginate(15);
        return view('report_list_poll', compact('polls'));
    }

    public function showPoll($id){
        $poll_users = PollQuestion::where('poll_id',$id)->orderBy('sort_order','asc')->paginate(30);
        return view('report_poll_answers_users', compact('poll_users'));
    }


}
