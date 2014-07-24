<?php

abstract class HttpRequest {

    abstract function sendRequest($url);

    /**
     * Processes the array being passed and returns a properly formatted string for the HTTP request
     * @param array $data The data that will be sent as part of the request
     * @return string The data in the appropriate format for an HTTP request
     */
    protected function setData($data) {
        $requestString = "";
        foreach($data as $key => $value) {
            $requestString .= urlencode($key) . "=" . urlencode($value);
            $requestString .= "&";
        }
        $requestString = rtrim($requestString, "&");
        return $requestString;
    }

}

?>