using System.Net;
using System.Text;

namespace Server;

internal class Program
{
    public static async Task Main(string[] args)
    {
        string url = "http://127.0.0.1:888/";

        using HttpListener listener = new HttpListener();

        listener.Prefixes.Add(url);
        listener.Start();

        Console.WriteLine("Listening for connections on " + url);

        byte[] indexFile = await GetHtmlDataAsync();

        while (true)
        {
            HttpListenerContext context = await listener.GetContextAsync();
            HttpListenerRequest request = context.Request;
            HttpListenerResponse response = context.Response;

            response.ContentLength64 = indexFile.Length;
            response.ContentType = "text/html";

            await response.OutputStream.WriteAsync(indexFile, 0, indexFile.Length);
            response.Close();
        }
    }

    private static async Task<byte[]> GetHtmlDataAsync()
    {
        byte[] result;
        try
        {
            using StreamReader reader = new StreamReader("index.html");
            
            string data = await reader.ReadToEndAsync();

            result = Encoding.UTF8.GetBytes(data);

        }
        catch (FileNotFoundException)
        {
            Console.WriteLine("index.html was not found in the root folder");
            throw;
        }

        return result;
    }
}
