<?php

require_once "HttpRequest.php";

final class Post extends HttpRequest {

    private $data;
    private $ssl;

    /**
     * Sets the data to be sent along with the request and specifies if the connection should be secure or not
     * @param array $data The data to be sent along with the request
     * @param boolean $ssl If the request should be sent over SSL or not
     */
    public function __construct($data, $ssl) {
        $this->data = $this->setData($data);
        $this->ssl = $ssl;
    }

    /**
     * Sends a POST request to the specified URL
     * @param string $url The URL to send the request to
     * @return string The response from the request
     */
    public function sendRequest($url) {
        $ch = curl_init();
        if($this->ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}

?>