<?php
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 11:30
 */
namespace TweetOfTheDay;
require_once __DIR__ . '/bootstrap/bootstrap.php';
use Slim\Slim;
use TweetOfTheDay\MainController\MainController;

$controller = new MainController();

$app = new Slim();
$app->contentType('application/json');

$app->post('/tweet', function() use ($app, $controller) {
    //get email
    $email = $app->request->post('email');
    //get tweet name
    $tweetName = $app->request->post('name');
    if (empty($email) || empty($tweetName)) {
        $app->response->setStatus(501);
        $app->response->body(json_encode(array(
            "message" => "Invalid Request"
        )));
    } else {
        //get the most relevant tweet
        $result = $controller->sendRelevantTweet($tweetName, $email);
        if (empty($result['error'])) {
            $app->response->setStatus(200);
            $app->response->body(json_encode($result));
        } else {
            if ($result['error'] == "Tweet Not Found") {
                $app->response->setStatus(404);
                $app->response->body(json_encode(array(
                    "message" => $result['error']
                )));
            } else {
                $app->response->setStatus(500);
                $app->response->body(json_encode(array(
                    "message" => $result['error']
                )));
            }
        }

    }
});
$app->run();