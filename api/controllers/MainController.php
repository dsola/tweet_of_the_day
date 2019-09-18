<?php
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 14:11
 */
namespace TweetOfTheDay\MainController;
use TweetOfTheDay\Services\TwitterService\TwitterService;
use TweetOfTheDay\Services\MailService\MailService;

class MainController {

    protected $TwitterService;
    protected $MailService;

    public function __construct() {
        $this->TwitterService = new TwitterService();
        $this->MailService = new MailService();
    }

    private function getRelevantTweet($name) {
        $twitter = $this->TwitterService->getRelevant($name);
        if ($twitter)
            return $twitter['text'];
        else return false;
    }

    private function SendMail($email, $subject, $body) {
        return $this->MailService->send($email, $subject, $body);

    }

    public function sendRelevantTweet($tweet, $email) {

        $text = $this->getRelevantTweet($tweet);
        if ($text) {
            $subject = 'The Most Relevant Tweet';
            $mailResponse = $this->sendMail($email, $subject, $text);
            if ($mailResponse != 'Message has been sent') {
                $error = $mailResponse;
            }
        } else {
            $error = "Tweet Not Found";
        }

        if (isset($error)) {
            return array(
                "error" => $error
            );
        } else {
            return array(
                "tweet" => $text,
                "mail" => $mailResponse
            );
        }
    }
}