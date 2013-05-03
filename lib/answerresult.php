<?php

class AnswerResult {
    
    protected $question_id=null;
    protected $answer_id=null;
    protected $answer_text=null;
    
    public function __construct() {
        if(empty($json)) {
             $json = file_get_contents("php://input");
             // if $json is still empty, there was nothing in 
             // the POST so throw exception
          if(empty($json)) {
               throw new Exception('No JSON available.', 1);
           }
         }
        $result = json_decode($json);
        if (!is_object($result)) {
           throw new Exception('Not a result object.');
        }
        $this->question_id = $result->question_id;
        $this->answer_id = $result->answer_id;
        $this->answer_text = $result->answer_text;
    }
    
    public function getQuestionId() {
        return $this->question_id;
    }
    
    public function getAnswerId() {
        return $this->answer_id;
    }
    
    public function getAnswerText() {
        return $this->answer_text;
    }
}
?>
