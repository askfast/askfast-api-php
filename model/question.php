<?php
require_once('askfast_object.php');

class Question extends AskFastObject {
    
    public $question_id=null;
    public $question_text=null;
    public $type=null;
    public $url=null;
    public $requester=null;
    public $answers=null;
    public $event_callbacks=null;
    public $media_properties=null;
    
    
    public function __construct() {
        $this->answers=Array();
        $this->event_callbacks=Array();
        $this->media_properties=Array();
    }
    
    public function addAnswer($answer) {
        $this->answers[] = $answer;
    }
    
    public function addEventCallback($eventCallback) {
        $this->event_callbacks[] = $eventCallback;
    }

    public function getMediaPropertiesByMedium($medium){
        foreach($this->media_properties as $property) {
            if($property->medium == $medium)
                return $property;
        }

        return new MediaPropery($medium);
    }

    public function addMediaProperty($mediaProperty) {
        $property = $this->getMediaPropertiesByMedium($mediaProperty->medium);

        $property->properties = array_merge($property->properties, $mediaProperty->properties);
        $this->setMediaProperty($mediaProperty);
    }

    public function setMediaProperty($mediaProperty) {
        for($i=0;$i<count($this->media_properties);$i++) {
            if($this->media_properties[$i]->medium == $mediaProperty->medium) {
                return $this->media_properties[$i] = $mediaProperty;
            }
        }

        $this->media_properties[] = $mediaProperty;
    }
}
?>
