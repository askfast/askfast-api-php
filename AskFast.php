<?php
require_once('question.php');
require_once('answer.php');

class AskFast {
    
    protected $response = null;
    
    public function __construct() {
        $this->response = new Question();
        $this->response->setQuestion_id=1;
        $this->response->setQuestion_url="text://";
    }
    
    public function ask($ask, $answers) {
        
    }
    
    public function say($say, $next) {
                
        $this->response->setQuestion_url.=$say;
        $this->response->setType.="comment";
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
