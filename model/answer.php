<?php
require_once('askfast_object.php');

class Answer extends AskFastObject {
    
    public $answer_id=null;
    public $answer_text=null;
    public $callback=null;
    
    public function __construct($answer_id, $answer_text, $callback) {
        $this->answer_id = $answer_id;
        $this->answer_text = $answer_text;
        $this->callback = $callback;
    }
}
?>
