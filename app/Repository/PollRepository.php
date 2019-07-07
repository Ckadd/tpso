<?php 

namespace App\Repository;
use App\Model\Poll;
use App\Model\PollQuestion;
use App\Model\PollAnswer;
use App\Model\PollAnswersUser;
class PollRepository {

    protected $poll;

    public function __construct(Poll $poll,
                                PollQuestion $question,
                                PollAnswersUser $answerUser,
                                PollAnswer $answer
    ) {
        $this->poll = $poll;
        $this->question = $question;
        $this->answerUser = $answerUser;
        $this->answer = $answer;
    }

    public function getByTypePoll($slug) {
        return $this->poll::where('polls.slug','=',$slug)
           // ->whereDate('end_date','<=',date('Y-m-d'))
            ->first();
    }

    public function getQuestionByTypePoll($poll_id) {
        return $this->question::where('poll_id','=',$poll_id)
            ->first();
    }

    public function getQuestionByAnswer($answer_id,$poll_id) {
        $answerData = $this->answer::where('id','=',$answer_id)
            ->first();
        return $this->question::where('id','=',$answerData->question_id)
            ->where('poll_id','=',$poll_id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function getQuestionByTypePollAndActive($poll_id,$order) {

        if(!empty($order)) {
            return $this->question::where('poll_id', $poll_id)
                ->where('sort_order', '>', $order)
                ->orderBy('sort_order', 'asc')
                ->first();
        }
        return 0;

    }

    public function insertAnswer($data) {
        return $this->answerUser::insertGetId($data); //return id
    }

    public function checkIp($ip,$poll_id) {
        return $this->answerUser::where('ip','=',$ip)
            ->where('poll_id','=',$poll_id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

}
