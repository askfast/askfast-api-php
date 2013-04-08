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
        $this->response->question_id=1;
        $this->response->question_url="text://";
    }
    
    public function ask($ask, $type, $next) {
        $this->response->question_url.=$ask;
        $this->response->type=$type;
        
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $next));
    }
    
    public function addAnswer($answer, $url) {
        
        if($this->response!=self::QUESTION_TYPE_CLOSED)
            throw new Exception("Adding question can only be done to closed questions");
        
        $this->response->addAnswer(new Answer($this->response->size(), $answer, $url));
    }
    
    public function say($say, $next) {
                
        $this->response->question_url.=$say;
        $this->response->type=self::QUESTION_TYPE_COMMENT;
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $next));
    }
    
    public function redirect($to, $next) {
        
    }
    
    public function hangup() {
         $this->response = new stdClass;
    }
    
    public function finish() {
        echo json_encode($this->response);
    }
}
?>
