import urllib2
import HttpRequest

class Get(HttpRequest.HttpRequest):
    
    data = None

    def __init__(self, data):
        self.data = self._setData(data)
        
    def sendRequest(self, url):
        return urllib2.urlopen(url+self.data).read()
        
    def _setData(self, data):
        queryString = "?"
        
        for(key, value) in data.iteritems():
            queryString += urllib2.quote(key) + "="+ urllib2.quote(value) + "&"
        
        queryString = queryString.rstrip("&")
            
        return queryString