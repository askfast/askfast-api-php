<?php
require_once('askfast/AskFast.php');
require_once('askfast/lib/session.php');
require_once('askfast/lib/answerresult.php');

    $filename = 'closed_question_example.php';
    $askfast = new AskFast();

    function app_start() {
        global $askfast;
        global $filename;
        $session = new Session();
        
        $askfast->ask('Are you coming to the football tournament at 17:00 on Friday? ऒ',AskFast::QUESTION_TYPE_CLOSED);
        $askfast->addAnswer('YES', $filename.'?function=thankyou&res=yes');
        $askfast->addAnswer('NO', $filename.'?function=thankyou&res=no');
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
        $text = 'Pity, see you in next time.';
        if($res=='yes') {
          $text = 'Yes it is great, here is the address: Kralingseweg 226 3062 CG Rotterdam';
        }
        
        $askfast->say($text);        
        return $askfast->finish();
    }
    
    function app_failure() {
        global $askfast;
        $askfast->say('Error');
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
