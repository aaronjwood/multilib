<?php

abstract class HttpRequest {

    abstract function sendRequest($url);

    /**
     * Processes the array being passed and returns a properly formatted string for the HTTP request
     * @param array $data
     * @return string
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