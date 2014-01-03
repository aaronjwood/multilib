using System.Collections.Specialized;
using System.Net;

namespace Multilib
{
    public class Post : HttpRequest
    {
        private NameValueCollection data;

        /// <summary>
        /// Initializes a new instance of the <see cref="Multilib.Post"/> class.
        /// </summary>
        /// <param name='data'>
        /// The data to be sent along with the POST request
        /// </param>
        public Post(NameValueCollection data)
        {
            this.data = data;
        }

        /// <summary>
        /// Sends the POST request.
        /// </summary>
        /// <returns>
        /// The response string
        /// </returns>
        /// <param name='url'>
        /// The URL to send the POST request to
        /// </param>
        public override string sendRequest(string url)
        {
            using (WebClient client = new WebClient())
            {
                //Accept all certs
                ServicePointManager.ServerCertificateValidationCallback = delegate { return true; };

                return System.Text.Encoding.UTF8.GetString(client.UploadValues(url, "POST", this.data));
            }
        }
    }
}

