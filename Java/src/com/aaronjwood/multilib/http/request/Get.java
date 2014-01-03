package com.aaronjwood.multilib.http.request;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.net.ssl.HttpsURLConnection;

public final class Get extends HttpRequest {

    private String data;
    private boolean ssl;

    /**
     * Sets the data to be sent along with the request and specifies if the
     * connection should be secure or not
     *
     * @param data The data to be sent along with the request
     * @param ssl Indicates if the connection should be secure or not
     */
    public Get(Map<String, String> data, boolean ssl) {
        this.data = this.setData(data);
        this.ssl = ssl;
    }

    /**
     * Sends a GET request to the specified URL
     *
     * @param url The URL to send the request to
     * @return The response data
     * @throws IOException
     */
    @Override
    public String sendRequest(String url) throws IOException {
        HttpURLConnection connection;

        //Do we need a secure connection or not?
        if (this.ssl == true) {
            connection = (HttpsURLConnection) new URL(url + "?" + this.data).openConnection();
        }
        else {
            connection = (HttpURLConnection) new URL(url + "?" + this.data).openConnection();
        }

        connection.setRequestMethod("GET");
        StringBuilder response;
        try (BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()))) {
            response = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) {
                response.append(line);
            }
        }
        return response.toString();
    }

    /**
     * Processes the map being passed and returns a properly formatted string
     * for the GET request
     *
     * @param data The map containing the key/value pairs
     * @return A properly formatted string of data for the GET request
     */
    @Override
    protected String setData(Map<String, String> data) {
        StringBuilder requestString = new StringBuilder();
        int counter = 0;
        for (Map.Entry<String, String> value : data.entrySet()) {
            try {
                counter++;
                requestString.append(URLEncoder.encode(value.getKey(), "UTF-8")).append("=").append(URLEncoder.encode(value.getValue(), "UTF-8"));
                if (counter < data.size()) {
                    requestString.append("&");
                }
            }
            catch (UnsupportedEncodingException ex) {
                Logger.getLogger(Get.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        return requestString.toString();
    }

}
