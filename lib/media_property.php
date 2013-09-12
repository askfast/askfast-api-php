<?php

class MediaPropery {

    const TYPE_BROADSOFT = "Broadsoft";
    const TYPE_GTALK = "GTalk";
    const TYPE_SMS = "SMS";
    const TYPE_EMAIL  = "Email";

    const PROPERTY_KEY_REDIRECTTIMEOUT = "timeout";
    const PROPERTY_KEY_TYPE = "type";


    public $medium = null;
    public $properties = null;

    public function __construct($medium=null) {
        $this->medium = $medium;
        $this->properties = array();
    }

    public function addProperty($key, $value) {
        $this->properties[$key] = $value;
    }
}

?>