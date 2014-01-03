using System;
using System.Collections.Generic;
using System.Net;
using System.Text;

namespace Multilib
{
    public class Get : HttpRequest
    {
        private Dictionary<string, string> data;

        /// <summary>
        /// Initializes a new instance of the <see cref="Multilib.Get"/> class.
        /// </summary>
        /// <param name='data'>
        /// The data to be sent along with the GET request
        /// </param>
        public Get(Dictionary<string, string> data)
        {
            this.data = data;
        }

        /// <summary>
        /// Sends the GET request.
        /// </summary>
        /// <returns>
        /// The response string
        /// </returns>
        /// <param name='url'>
        /// The URL to send the GET request to
        /// </param>
        public override string sendRequest(string url)
        {
            using (WebClient client = new WebClient())
            {
                //Accept all certs
                ServicePointManager.ServerCertificateValidationCallback = delegate { return true; };

                return client.DownloadString(url + this.buildQueryString());
            }
        }

        /// <summary>
        /// Builds the query string and properly encodes the keys and values
        /// </summary>
        /// <returns>
        /// The generated query string
        /// </returns>
        private string buildQueryString()
        {
            StringBuilder queryString = new StringBuilder();
            queryString.Append("?");

            foreach (KeyValuePair<string, string> entry in this.data)
            {
                queryString.Append(Uri.EscapeDataString(entry.Key));
                queryString.Append("=");
                queryString.Append(Uri.EscapeDataString(entry.Value));
                queryString.Append("&");
            }
            return queryString.ToString().TrimEnd('&');
        }
    }
}

