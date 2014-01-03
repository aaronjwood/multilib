import urllib2
import HttpRequest

class Post(HttpRequest.HttpRequest):

    data = None

    def __init__(self, data):
        self.data = self._setData(data)
        
    def sendRequest(self, url):
        request = urllib2.Request(url, self.data)
        response = urllib2.urlopen(request)
        print response.read()
        
    def _setData(self, data):
        queryString = ""
        
        for(key, value) in data.iteritems():
            queryString += urllib2.quote(key) + "="+ urllib2.quote(value) + "&"
        
        queryString = queryString.rstrip("&")
            
        return queryString