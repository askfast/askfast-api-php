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
                
        $this->url = 'http://'.$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']).'/';

        $this->response = new Question();
        $this->response->question_id=1;
        $this->response->question_text="text://";
    }
    
    public function ask($ask, $type, $next=null) {
        $this->response->question_text.=$ask;
        $this->response->type=$type;
        
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $this->url.$next));
    }
    
    public function addAnswer($answer, $url) {
        
        if($this->response->type!=self::QUESTION_TYPE_CLOSED)
            throw new Exception("Adding question can only be done to closed questions");
        $this->response->addAnswer(new Answer(count($this->response->answers)+1, "text://".$answer, $this->url.$url));
    }
    
    public function say($say, $next=null) {
                
        $this->response->question_text.=$say;
        $this->response->type=self::QUESTION_TYPE_COMMENT;
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $this->url.$next));
    }
    
    public function redirect($to, $next) {
        
    }
    
    public function hangup() {
         $this->response = new stdClass;
    }
    
	public function finish() { 
		echo $this->unescapeJSON($this->response->toJSON());
    }

	protected function unescapeJSON($json) {
		return str_replace(array("\\", "\"{", "}\""), array("", "{", "}"), $json);
	}
}
?>
