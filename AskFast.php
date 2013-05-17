<?php
require_once('lib/question.php');
require_once('lib/answer.php');

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
    }
    
    public function ask($ask, $type, $next=null) {
        
        if($this->response->question_text=="") {
            // If the answer start with a slash it is a file
            // and the host path should be added.
            if(strpos($ask, "/")===0) {
                $this->response->question_text = $this->url.substr($ask,1);
            }
            
            // if it ends with wav it is a audio file
            // so if not we should add text://
            else if(!(substr($ask, -strlen(".wav")) == ".wav")) {
                $this->response->question_text = "text://".$ask;
            } else {
                $this->response->question_text = $ask;
            }
        } else {
            // if it ends with wav it is a audio file
            // so if not we should add text://
            if(!(substr($ask, -strlen(".wav")) == ".wav")) {
                $this->response->question_text.=$ask;
            }
        }
        $this->response->type=$type;
        
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $this->url.$next));
    }
    
    public function addAnswer($answer, $url) {
        
        // If the answer start with a slash it is a file
        // and the host path should be added.
        if(strpos($answer, "/")===0) {
            $answer = $this->url.substr($answer,1);
        }
        
        // if it ends with wav it is a audio file
        // so if not we should add text://
        if(!(substr($answer, -strlen(".wav")) == ".wav")) {
            $answer = "text://".$answer;
        }
        
        if($this->response->type!=self::QUESTION_TYPE_CLOSED)
            throw new Exception("Adding question can only be done to closed questions");
        $this->response->addAnswer(new Answer(count($this->response->answers)+1, $answer, $this->url.$url));
    }
    
    public function say($say, $next=null) {
                
        if($this->response->question_text=="") {
            // If the answer start with a slash it is a file
            // and the host path should be added.
            if(strpos($say, "/")===0) {
                $this->response->question_text = $this->url.substr($say,1);
            }
            
            // if it ends with wav it is a audio file
            // so if not we should add text://
            else if(!(substr($say, -strlen(".wav")) == ".wav")) {
                $this->response->question_text = "text://".$say;
            } else {
                $this->response->question_text = $say;
            }
        } else {
            // if it ends with wav it is a audio file
            // so if not we should add text://
            if(!(substr($say, -strlen(".wav")) == ".wav")) {
                $this->response->question_text.=$say;
            }
        }
        
        $this->response->type=self::QUESTION_TYPE_COMMENT;
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $this->url.$next));
    }
    
    public function redirect($to, $say=null, $next=null) {
        
        $this->response->type="referral";
        $this->response->url=$to;
        
        if($say!=null) {
            // If the answer start with a slash it is a file
            // and the host path should be added.
            if(strpos($say, "/")===0) {
                $this->response->question_text = $this->url.substr($say,1);
            }
            
            // if it ends with wav it is a audio file
            // so if not we should add text://
            else if(!(substr($say, -strlen(".wav")) == ".wav")) {
                $this->response->question_text = "text://".$say;
            } else {
                $this->response->question_text = $say;
            }
        }
        
        if($next!=null)
            $this->response->addAnswer(new Answer(1, null, $this->url.$next));
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