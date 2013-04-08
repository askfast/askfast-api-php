<?php
class Question {
    
    protected $question_id=null;
    protected $question_url=null;
    protected $type=null;
    protected $url=null;
    protected $requester=null;
    protected $answers=null;
    protected $event_callbacks=null;
    
    
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
    
    public function setQuestion_id($questionId) {
        $this->question_id = $questionId;
    }
    
    public function setQuestion_url($questionUrl) {
        $this->question_url = $questionUrl;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function setUrl($url) {
        $this->url = $url;
    }
    
    public function setRequester($requester) {
        $this->requester = $requester;
    }
    
    public function toJSON() {
        return json_encode($this);
    }
}
?>
