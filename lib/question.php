<?php
class Question {
    
    public $question_id=null;
    public $question_text=null;
    public $type=null;
    public $url=null;
    public $requester=null;
    public $answers=null;
    public $event_callbacks=null;
    
    
    public function __construct() {
        $this->answers=Array();
        $this->event_callbacks=Array();
    }
    
    public function addAnswer($answer) {
        $this->answers[] = $answer;
    }
    
    public function addEventCallback($eventCallback) {
        $this->event_callbacks[] = $eventCallback;
    }
    
    public function toJSON() {
        return json_encode($this);
    }
}
?>
