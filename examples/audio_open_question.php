<?php
session_start();
require_once('askfast/AskFast.php');
require_once('askfast/lib/session.php');
require_once('askfast/lib/answerresult.php');

    $filename = 'audio_open_question.php';
    $askfast = new AskFast();

    function app_start() {
        global $askfast;
        global $filename;
        $session = new Session();
        
        $askfast->ask('/audio/nl/inspreken.wav','open', $filename.'?function=next');
        $askfast->addProperty(MediaPropery::TYPE_BROADSOFT, MediaPropery::PROPERTY_KEY_TYPE, "audio");
        $askfast->finish();
    }
        
    function app_hangup() {
        global $askfast;
        $askfast->hangup();
        $askfast->finish();
    }
    
    function app_next() {
        global $askfast;
        global $filename;
        $result = new AnswerResult();
        $url = $result->getAnswerText();
        
        $askfast->say('/audio/nl/ingesproken.wav', $filename.'?function=result&url='.$url);
        $askfast->finish();
    }
    
    function app_result() {
        global $askfast;
        global $filename;
        
        $audioFile = $_REQUEST["url"];
        error_log($audioFile."\n", 3, "test.log");
        $askfast->say($audioFile, $filename.'?function=thankyou&res=yes');
        $askfast->finish();
    }
    
    function app_thankyou(){
        global $askfast;
        global $uuid;
        
        $result = new AnswerResult();
        $res = $_GET['res'];
        if($res=='yes') {
          $askfast->say('/audio/nl/bedankt_voor_uw_invoer.wav');  
        } else {
          //TODO: Fill in real phone numnber
          $askfast->redirect('tel:+31612345678','/audio/nl/doorverbinden.wav');
        }
        
        return $askfast->finish();
    }
    
    function app_failure() {
        
        $askfast->say('/audio/nl/fout.wav');
        $askfast->finish();
    }

    $function    =    'start';

    if (isset($_REQUEST['function']) && $_REQUEST['function'] != '') {
        $function    =    $_REQUEST['function'];
    }

    switch ($function) {
        case 'hangup':        app_hangup();        break;
        case 'start':        app_start();        break;
        case 'next':        app_next();        break;
        case 'result':        app_result();        break;
        case 'thankyou':        app_thankyou();        break;
        default:        app_failure();
    }
?>
