<?php
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 11:30
 */
namespace TweetOfTheDay;
header('Content-type: text/json');
require_once __DIR__ . '/bootstrap/bootstrap.php';
use Slim\Slim;
use TweetOfTheDay\MainController\MainController;

$controller = new MainController();

switch($_REQUEST['op']) {
    case "tweet":
        $email = $_POST['email'];
        $tweetName = $_POST['name'];
        if (empty($email) || empty($tweetName)) {
            http_response_code(501);
            print json_encode(array(
                "message" => "Invalid Request"
            ));
        } else {
            //get the most relevant tweet
            $result = $controller->sendRelevantTweet($tweetName, $email);
            if (empty($result['error'])) {
                http_response_code(200);
                print json_encode($result);
            } else {
                if ($result['error'] == "Tweet Not Found") {
                    http_response_code(404);
                    print json_encode(array(
                        "message" => $result['error']
                    ));
                } else {
                    http_response_code(500);
                    print json_encode(array(
                        "message" => $result['error']
                    ));
                }
            }
        }
    break;
}