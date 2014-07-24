package com.aaronjwood.multilib.http.request;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.Map;

public abstract class HttpRequest {

    abstract String sendRequest(String url) throws IOException;

    abstract String setData(Map<String, String> data) throws UnsupportedEncodingException;

}
