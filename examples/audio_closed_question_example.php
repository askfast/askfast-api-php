<?php
require_once('askfast/AskFast.php');
require_once('askfast/lib/session.php');
require_once('askfast/lib/answerresult.php');

    $filename = 'audio_closed_question_example.php';
    $askfast = new AskFast();

    function app_start() {
        global $askfast;
        global $filename;
        $session = new Session();
        
        $askfast->ask('/audio/nl/hoe_vind_u_dit_voorbeeld.wav',AskFast::QUESTION_TYPE_CLOSED);
        $askfast->addAnswer('/audio/nl/empty.wav', $filename.'?function=thankyou&res=yes');
        $askfast->addAnswer('/audio/nl/empty.wav', $filename.'?function=thankyou&res=no');
        $askfast->finish();
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
          $askfast->say('/audio/nl/bedankt_voor_uw_invoer.wav');  
        } else {
          $askfast->redirect('tel:+31643002549','/audio/nl/doorverbinden.wav');
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
        case 'thankyou':        app_thankyou();        break;
        default:        app_failure();
    }
?>
