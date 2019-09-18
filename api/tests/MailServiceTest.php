<?php
require_once __DIR__ . '/../bootstrap/bootstrap.php';
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 12:53
 */

use TweetOfTheDay\Services\MailService\MailService;

class MailServiceTest extends PHPUnit_Framework_TestCase
{
    protected $MailService;

    public function setUp() {
        $this->MailService = new MailService();
    }

    public function testSend() {
        $email = 'd.sola.03@gmail.com';
        $subject = 'Test';
        $body = '<b>This is a test.</b>';
        $response = $this->MailService->send($email, $subject, $body);
        $this->assertEquals('Message has been sent', $response);
    }


}