<?php
require_once __DIR__ . '/../bootstrap/bootstrap.php';
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 14:22
 */
use TweetOfTheDay\MainController\MainController;

class ControllerTest extends PHPUnit_Framework_TestCase
{
    protected $Controller;

    public function setUp() {
        $this->Controller = new MainController();
    }

    public function testGetMostRelevantTweet() {
        $tweet = "BarçaMadrid";
        $email = "d.sola.03@gmail.com";
        $this->Controller->sendRelevantTweet($tweet, $email);
    }

}