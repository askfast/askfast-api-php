<?php
class Answer {
    
    public $answer_id=null;
    public $answer_text=null;
    public $answer_callback=null;
    
    public function __construct($answer_id, $answer_text, $answer_callback) {
        $this->answer_id = $answer_id;
        $this->answer_text = $answer_text;
        $this->answer_callback = $answer_callback;
    }
    
    public function toJSON() {
        return json_encode($this);
    }
}
?>
