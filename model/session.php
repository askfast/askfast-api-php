<?php
class Session {
    
    protected $requester=null;
    protected $responder=null;
    protected $preferred_language=null;
    
    public function __construct() {
        // TODO: read info from query params    
        $this->requester = (isset($_REQUEST['requester']) ? $_REQUEST['requester'] : null);
        $this->responder = (isset($_REQUEST['responder']) ? $_REQUEST['responder'] : null);
        $this->preferred_language = (isset($_REQUEST['preferred_language']) ? $_REQUEST['preferred_language'] : null);
    }
    
    public function getRequester() {
        return $this->requester;
    }
    
    public function getResponder() {
        return $this->responder;
    }
        
    public function getPreferredLanguage() {
        return $this->preferred_language;
    }
}
?>
