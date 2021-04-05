<?php

require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../config.php';

class SMTPClient {

    public function __construct() {

        private $mailer;

           // Create the Transport
           $transport = (new Swift_SmtpTransport(Config::SMTP_HOST, Config::SMTP_PORT))
           ->setUsername(Config::SMTP_USER)
           ->setPassword(Config::SMTP_PASSWORD)
           ;
           
           // Create the Mailer using your created Transport
           $this->$mailer = new Swift_Mailer($transport);
    }

    public function send_register_user_token($account) {

        // Create a message
        $message = (new Swift_Message('Confirm your account'))
        ->setFrom(['faris@bekta.me' => 'Flight Reservation'])
        ->setTo([$account['email']])
        ->setBody('Here is the confirmation link: http://localhost/flight-reservation/api//accounts/confirm/'.$account['token']);
        ;
        
        // Send the message
       $this->$mailer->send($message);
    }

    /*public function send_user_recovery_token($account) {
        // Create a message
        $message = (new Swift_Message('Reset your password'))
        ->setFrom(['faris@bekta.me' => 'Flight Reservation'])
        ->setTo([$account['email']])
        ->setBody('Here is the confirmation token:   ')
        ;
        
        // Send the message
       $mailer->send($message);
    }*/
}

        
        

?>