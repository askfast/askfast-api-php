<?php
require_once('askfast/AskFast.php');
require_once('askfast/lib/session.php');
require_once('askfast/lib/answerresult.php');

    $filename = 'audio_closed_question_example.php';
    $askfast = new AskFast();

    function app_start() {
        global $askfast;
        $session = new Session();
        
        $askfast->ask('/askfast/audio/nl/hoe_vind_u_dit_voorbeeld.wav',AskFast::QUESTION_TYPE_CLOSED);
        $askfast->addAnswer(new Answer(1,'/askfast/audio/nl/empty.wav', $filename.'?function=thankyou&res=yes'));
        $askfast->addAnswer(new Answer(2,'/askfast/audio/nl/empty.wav', $filename.'?function=thankyou&res=no'));
    }
        
    function app_hangup() {
        global $askfast;
        $askfast->hangup();
        $askfast->finish();
    }
    
    function app_thankyou(){
        global $askfast;
        global $uuid;
        
        
        $result = new AnswerResult();
        $res = $_GET['res'];
        if($res=='yes') {
          $askfast->say('/askfast/audio/nl/bedankt_voor_invoer.wav');  
        } else {
          $askfast->say('/askfast/audio/nl/bedankt_voor_invoer.wav');  
        }
        
        return $askfast->finish();
    }
    
    function app_failure() {
        
        $askfast->say('/askfast/audio/nl/fout.wav');
        $askfast->finish();
    }

    $function    =    'start';

    if (isset($_REQUEST['function']) && $_REQUEST['function'] != '') {
        $function    =    $_REQUEST['function'];
    }

    switch ($function) {
        case 'hangup':        app_hangup();        break;
        case 'start':        app_start();        break;
        case 'thankyou':        app_thankyou();        break;
        default:        app_failure();
    }
?>
