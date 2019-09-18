<?php
/**
 * Created by PhpStorm.
 * User: dsola
 * Date: 22/11/15
 * Time: 11:34
 */
namespace TweetOfTheDay\Services\TwitterService;
use TwitterAPIExchange;

class TwitterService {

    protected $TwitterAPIExchange;
    protected $oauth_access_token = '2391456422-x5iukY20UQSVqu5Mb53x4tRR8I4VL4SgOg6tAsM';
    protected $oauth_access_token_secret = 'UgyPUMSdUAQr6wcvPrTjsIWdsyqFglBs9Pad211uSM9fl';
    protected $consumer_key = 's8aIpOry6wa4qqH7OgxcvqoPS';
    protected $consumer_secret = 'pRN7qu2wVf4Ci6rGlYdhJcXLsBqwljpiU0Up38Jwm8qxdQg7sl';
    protected $apiURL = 'https://api.twitter.com/1.1/search/tweets.json';

    public function __construct() {
        $this->TwitterAPIExchange = new TwitterAPIExchange(array(
            'oauth_access_token' => $this->oauth_access_token,
            'oauth_access_token_secret' => $this->oauth_access_token_secret,
            'consumer_key' => $this->consumer_key,
            'consumer_secret' => $this->consumer_secret
        ));
    }

    public function getRelevant($name) {
        $fields = "?q=#$name&count=1&result_type=popular";
        $requestMethod = 'GET';
        $json = $this->request($fields, $requestMethod, $this->apiURL);
        $result = json_decode($json,TRUE);
        if (isset($result) &&
            isset($result['statuses'])
            && count($result['statuses']) > 0)
            return $result['statuses'][0];
        else return false;
    }

    private function request($fields, $method, $url) {
        return $this->TwitterAPIExchange->setGetfield($fields)->buildOauth($url, $method)->performRequest();
    }
}