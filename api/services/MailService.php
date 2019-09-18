<?php

/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 11:36
 */

namespace TweetOfTheDay\Services\MailService;
use PHPMailer;

class MailService
{
    protected $Message;
    protected $Mailer;
    protected $settings = array(
        'host' => 'smtp.gmail.com',
        'username' => 'd.sola.03@gmail.com',
        'password' => 'waudauhilpsucnyd',
        'port' => '587'
    );
    protected $from = array(
        'email' => 'david@alt17.com',
        'name' => 'Tweet of the Day'
    );

    public function __construct() {
        date_default_timezone_set('Etc/UTC');
        $this->Mailer = new PHPMailer();
        $this->Mailer->SMTPDebug = false;                               // Enable verbose debug output
        $this->Mailer->isSMTP();                                      // Set mailer to use SMTP
        $this->Mailer->Host = $this->settings['host'];  // Specify main and backup SMTP servers
        $this->Mailer->SMTPAuth = true;                               // Enable SMTP authentication
        $this->Mailer->Username = $this->settings['username'];                 // SMTP username
        $this->Mailer->Password = $this->settings['password'];                     // SMTP password
        $this->Mailer->SMTPSecure = "tls";
        $this->Mailer->Port = $this->settings['port'];                                    // TCP port to connect to
    }

    public function send($email, $subject, $body) {
        $this->createMessage($subject, $body);
        return $this->sendMail($email);
    }

    private function createMessage($subject, $body) {
        $this->Mailer->Subject = $subject;
        $this->Mailer->isHTML(true);                                  // Set email format to HTML
        $this->Mailer->Body    = $body;
    }

    private function sendMail($mail) {

        $this->Mailer->setFrom($this->from['email'], $this->from['name']);
        $this->Mailer->addAddress($mail);               // Add a recipient

        if(!$this->Mailer->send()) {
            return 'Message could not be sent.';
            return 'Mailer Error: ' . $this->Mailer->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }

}