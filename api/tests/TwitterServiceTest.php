<?php
require_once __DIR__ . '/../bootstrap/bootstrap.php';
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 12:10
 */
use TweetOfTheDay\Services\TwitterService\TwitterService;

class TwitterServiceTest extends PHPUnit_Framework_TestCase
{
    protected $TwitterService;

    public function setUp() {
        $this->TwitterService = new TwitterService();
    }

    public function testGetRelevant() {
        $name = 'apple';
        $tweet = $this->TwitterService->getRelevant($name);
        $this->assertEquals('Man whips out a samurai sword in the #Apple store. Witnesses react on @NBCNewYork now!!Cc: @margaretmhuerta https://t.co/odCUwGKCn3', $tweet['text']);
    }



}