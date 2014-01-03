<?php

abstract class HttpRequest {

    abstract function sendRequest($url);

    abstract protected function setData($data);
}

?>