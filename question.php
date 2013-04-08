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
    
    public function __set($propertyName, $propertyValue) {
        $this->{$propertyName} = $propertyValue;
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
