<?php

class EventCallback {

    const EVENT_TYPE_TIMEOUT = "timeout";
    const EVENT_TYPE_EXCEPTION = "exception";
    const EVENT_TYPE_HANGUP = "hangup";

    public $event=null;
    public $callback=null;

    public function __construct($event=null, $callback=null){
        $this->event = $event;
        $this->callback = $callback;
    }
}

?>