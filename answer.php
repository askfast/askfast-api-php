<?php
class Answer {
    
    protected $answer_id=null;
    protected $answer_text=null;
    protected $answer_callback=null;
    
    public function __construct($answer_id, $answer_text, $answer_callback) {
        $this->answer_id = $answer_id;
        $this->answer_text = $answer_text;
        $this->answer_callback = $answer_callback;
    }    
    
     public function __set($propertyName, $propertyValue) {
        $this->{$propertyName} = $propertyValue;
    }
    
    public function toJSON() {
        return json_encode($this);
    }
}
?>
