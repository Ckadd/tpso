<?php

namespace App\Http\Controllers;

use Request,Response,View;
//use Illuminate\Http\Request;
use File;
use Validator;
use App\Repository\PollRepository;
use App\Model\Poll;
use App\Model\PollQuestion;
use App\Model\PollAnswer;
use App\Model\PollAnswersUser;

class PollController extends Controller
{
    protected $pollRepository;
    public function __construct(
        PollRepository $pollRepository
    ) {
        $this->poll = $pollRepository;
    }

    protected $rulesCreate = [
        'name' => 'required|unique:polls|max:255',
        //'slug' => 'required|unique:polls|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'sort_order' => 'required',
    ];

    protected $rulesUpdate = [
        'name' => 'required|max:255',
        //'slug' => 'required|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'sort_order' => 'required',
    ];

    protected $rulesCreateQuestion = [
        'title' => 'required|max:255',
        'answer1' => 'required|max:255',
        'answer2' => 'required|max:255',
        'sort_order' => 'required',
    ];

    public function listPoll(){

        $polls = Poll::orderBy('sort_order','asc')->paginate(15);
        return view('list_poll', compact('polls'));
    }

    public function createPoll(){
        return view('create_poll');
    }

    public function storePoll(){
        Validator::make(Request::all(), $this->rulesCreate)->validate();
        $dataArr =array(
            "name"=>Request::input('name'),
            "slug"=>md5(date('ymd-h-i-s').Request::input('name')),
            'start_date'=>$newDate = date("Y-m-d", strtotime(Request::input('start_date'))),
            'end_date'=>date("Y-m-d", strtotime(Request::input('end_date'))),
            "sort_order"=>Request::input('sort_order'),
            "created_at"=>date('Y-m-d H:i:s')
        );

        Poll::insertGetId($dataArr);
        return redirect('admin/polls');
    }

    public function editPoll($poll_id){
        $data = Poll::find($poll_id);
        return view('edit_poll',compact('data'));
    }


    public function updatePoll($poll_id){
        Validator::make(Request::all(), $this->rulesUpdate)->validate();
        $dataArr =array(
            "name"=>Request::input('name'),
            'start_date'=>$newDate = date("Y-m-d", strtotime(Request::input('start_date'))),
            'end_date'=>date("Y-m-d", strtotime(Request::input('end_date'))),
            "sort_order"=>Request::input('sort_order'),
            "created_at"=>date('Y-m-d H:i:s')
        );

        Poll::where('id',$poll_id)->update($dataArr);
        return redirect('admin/polls');
    }

    public function listQuestion($poll_id){
        $qt = PollQuestion::where('poll_id',$poll_id)
            ->orderBy('sort_order','desc')->first();
        $order = 1;
        if(!empty($qt)){
            $order = $qt->sort_order+1;
        }
        $questions = PollQuestion::where('poll_id',$poll_id)
            ->orderBy('sort_order','asc')
            ->paginate(15);
        return view('list_question', compact('questions','poll_id','order'));
    }

    public function storeQuestionAndAnswer($poll_id){
        Validator::make(Request::all(), $this->rulesCreateQuestion)->validate();
        $dataQuestion =array(
            "title"=>Request::input('title'),
            "sort_order"=>Request::input('sort_order'),
            "poll_id"=>$poll_id,
            "created_at"=>date('Y-m-d H:i:s')
        );
        $question_id = PollQuestion::insertGetId($dataQuestion);
        $dataAnswerStatic = array(
            array('poll_id' => $poll_id,'question_id' => $question_id,'answer' => Request::input('answer1'),"created_at"=>date('Y-m-d H:i:s')),
            array('poll_id' => $poll_id, 'question_id' => $question_id,'answer' => Request::input('answer2'),"created_at"=>date('Y-m-d H:i:s'))
        );

        PollAnswer::insert($dataAnswerStatic);
        if(!empty(Request::input('answer'))) {
            foreach (Request::input('answer') as $v) {
                if (!empty($v)) {
                    $dataAnswerDri = array(
                        'poll_id' => $poll_id,
                        'question_id' => $question_id,
                        'answer' => $v,
                        "created_at"=>date('Y-m-d H:i:s')
                    );
                    PollAnswer::insertGetId($dataAnswerDri);
                }
            }
        }
        return redirect('admin/polls/'.$poll_id.'/questions');

    }

    public function editQuestionAndAnswer($poll_id,$question_id){
        $data = PollQuestion::find($question_id);
        return view('edit_question',compact('data','poll_id'));
    }


    public function updateQuestionAndAnswer($poll_id,$question_id){
        PollQuestion::where('id', $question_id)->update(['sort_order'=>Request::input('sort_order'),'title' => Request::input('title')]);
        //update Answer
        if(!empty(Request::input('answer_text'))) {
            $answer_arr_id = Request::input('answer_id');
            $count_index = 0;
            foreach (Request::input('answer_text') as $v) {
                if (!empty($v)) {
                    $dataAnswerOg = array(
                        'answer' => $v,
                        "updated_at"=>date('Y-m-d H:i:s')
                    );
                    PollAnswer::where('id',$answer_arr_id[$count_index])->update($dataAnswerOg);
                    $count_index++;
                }
            }
        }
        //insert Answer
        if(!empty(Request::input('answer_new'))) {
            foreach (Request::input('answer_new') as $v) {
                if (!empty($v)) {
                    $dataAnswerNew = array(
                        'poll_id' => $poll_id,
                        'question_id' => $question_id,
                        'answer' => $v,
                        "created_at"=>date('Y-m-d H:i:s')
                    );
                    PollAnswer::insertGetId($dataAnswerNew);
                }
            }
        }

        return redirect('admin/polls/'.$poll_id.'/questions/'.$question_id.'/edit');
    }


    public function destroyPoll($poll_id)
    {
        PollAnswer::where('poll_id',$poll_id)->delete();
        PollQuestion::where('poll_id',$poll_id)->delete();
        Poll::find($poll_id)->delete();
        return Response::json(['status' => 'Y']);
    }

    public function destroyQuestion($question_id){
        PollAnswer::where('question_id',$question_id)->delete();
        PollQuestion::find($question_id)->delete();
        return Response::json(['status' => 'Y']);
    }

    public function destroyAnswer($answer_id){
        PollAnswer::find($answer_id)->delete();
        return Response::json(['status' => 'Y']);
    }


    public function getPoll($slug){
        $ip =  \Request::getClientIp(true);
        dd($ip);
        $poll =  $this->poll->getByTypePoll($slug);
        if(empty($poll)){
            abort(404);
        }
        $user_ip = $this->poll->checkIp($ip,$poll->id);

        $data = array();
        if(!empty($user_ip)){
            $qu = $this->poll->getQuestionByAnswer($user_ip->answer_id,$user_ip->poll_id);
            $data =  $this->poll->getQuestionByTypePollAndActive($poll->id,$qu->sort_order);
            if(empty($data)){
                return view('thank');
            }

        }else{

            $data =  $this->poll->getQuestionByTypePoll($poll->id);
            if(empty($data)){
                return view('thank');
            }
        }
        //return $data; //$data->answers
        return view('poll',compact('data','poll'));
    }

    public function saveAnswer($slug){

        $ip =  $_SERVER['REMOTE_ADDR'];
        $rules = array(
            'answer_id' => 'required'
        );

        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/poll/'.$slug)
                ->withErrors($validator)
                ->withInput();
        }
        $poll = $this->poll->getByTypePoll($slug);
        $dataArr =array(
            "answer_id"=>Request::input('answer_id'),
            "ip"=>$ip,
            "poll_id"=>$poll->id,
            "created_at"=>date('Y-m-d H:i:s')
        );
        $this->poll->insertAnswer($dataArr);
        return redirect('/poll/'.$slug);
    }


}
