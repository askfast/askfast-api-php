<?php
require_once('question.php');
require_once('answer.php');

class AskFast {
    
    const QUESTION_TYPE_OPEN="open";
    const QUESTION_TYPE_CLOSED="closed";
    const QUESTION_TYPE_COMMENT="comment";
    
    protected $response = null;
    protected $url = null;
    
    public function __construct() {
                
        $this->url = $_SERVER['HTTP_HOST'];
        
        $this->response = new Question();
        $this->response->setQuestion_id=1;
        $this->response->setQuestion_url="text://";
    }
    
    public function ask($ask, $type, $next) {
        $this->response->setQuestion_url.=$ask;
        $this->response->setType=$type;
        
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $next));
    }
    
    public function addAnswer($answer, $url) {
        
        if($this->response!=self::QUESTION_TYPE_CLOSED)
            throw new Exception("Adding question can only be done to closed questions");
        
        $this->response->addAnswer(new Answer($this->response->size(), $answer, $url));
    }
    
    public function say($say, $next) {
                
        $this->response->setQuestion_url.=$say;
        $this->response->setType=self::QUESTION_TYPE_COMMENT;
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $next));
    }
    
    public function redirect($to, $next) {
        
    }
    
    public function hangup() {
         $this->response = new stdClass;
    }
    
    public function finish() {
        echo json_encode($response);
    }
}
?>
