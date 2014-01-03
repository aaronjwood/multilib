from abc import ABCMeta, abstractmethod

class HttpRequest(object):

    __metaclass__ = ABCMeta
    
    @abstractmethod
    def sendRequest(self, url):
        return
    
    @abstractmethod
    def _setData(self, data):
        return