<?php
require_once('askfast/AskFast.php');
require_once('askfast/lib/session.php');
require_once('askfast/lib/answerresult.php');

    $askfast = new AskFast();

    function app_start() {
        global $askfast;
        $session = new Session();
        global $uuid;
        
        try {
            $result = new AnswerResult();
            if($result->getAnswerText()!=null && $result->getAnswerText()!='') {
                if($result->getAnswerText()=='admin')
                    $uuid='admin';
            }
            
        } catch(Exception $e) {
            
            if($session->getResponder()!=null) {
                if($result->getAnswerText()=='admin')
                    $uuid='admin';
                if($uuid==null)
                    app_unknownuser();
                else
                    app_question1();
                return;
            }
            app_unknownuser();
        }
        
        app_unknownuser();
    }
    
    function app_unknownuser() {
        global $askfast;
        $askfast->ask("Deze gebruiker is niet bij ons bekend. Wat is uw gebruikersnaam?",  AskFast::QUESTION_TYPE_OPEN, 'set_availability.php?function=start');
        $askfast->finish();
    }
    
    function app_question1() {
        global $askfast;
        global $uuid;        
        
        $askfast->ask("Wilt u zichzelf beschikbaar stellen", AskFast::QUESTION_TYPE_CLOSED);
        $askfast->addAnswer("ja", 'set_availability.php?function=beschikbaar&uuid='.$uuid);
        $askfast->addAnswer("nee", 'set_availability.php?function=niet_beschikbaar&uuid='.$uuid);
        $askfast->finish();
    }
    
    function app_beschikbaar() {
        global $askfast;
        global $uuid;
        
        $askfast->ask("Hoelang bent u beschikbaar? (uur)",  AskFast::QUESTION_TYPE_OPEN, 'set_availability.php?function=thankyou&avail=true&uuid='.$uuid);
        $askfast->finish();
    }
    
    function app_niet_beschikbaar() {
        global $askfast;
        global $uuid;
        
        $askfast->ask("Hoelang bent u afwezig? (uur)",  AskFast::QUESTION_TYPE_OPEN, 'set_availability.php?function=thankyou&avail=false&uuid='.$uuid);
        $askfast->finish();
    }
    
    function app_failure() {
        global $askfast;

        $askfast->say('Er is iets mis gegaan. Bedankt voor het bellen. De verbinding wordt nu verbroken.', 'set_availability.php?function=hangup');
        return $askfast->finish();
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
        $avail = $_GET['avail'];
        $hours = $result->getAnswerText();
        // TODO: create check on the hours
        
        if($avail=='true') {
            createTimeSlot($hours, true);
            $askfast->say('Bedankt voor uw aanmelding.', 'set_availability.php?function=hangup');
        } else {
            createTimeSlot($hours, false);
            $askfast->say('Bedankt voor uw afmelding.', 'set_availability.php?function=hangup');
        }
        return $askfast->finish();
    } 
    
    function createTimeSlot($hours, $avail) {
        //Create timeslot   
    }

    $function    =    'start';

    if (isset($_REQUEST['function']) && $_REQUEST['function'] != '') {
        $function    =    $_REQUEST['function'];
    }
    
    if (isset($_REQUEST['uuid']) && $_REQUEST['uuid'] != '') {
        $uuid    =    $_REQUEST['uuid'];
    }

    switch ($function) {
        case 'hangup':        app_hangup();        break;
        case 'start':        app_start();        break;
        case 'question1':        app_question1();        break;
        case 'beschikbaar':        app_beschikbaar();        break;
        case 'niet_beschikbaar':        app_niet_beschikbaar();        break;
        case 'thankyou':        app_thankyou();        break;
        default:        app_failure();
    }
?>
