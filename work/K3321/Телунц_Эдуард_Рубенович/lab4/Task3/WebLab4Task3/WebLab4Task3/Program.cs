using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace WebLab4Task3
{
    internal class Program
    {
        static async Task Main(string[] args)
        {
            int port = 888; // Порт по умолчанию

            Console.WriteLine("Введите номер порта для сервера:");
            var inputPort = Console.ReadLine();

            if (int.TryParse(inputPort, out int parsedPort))
            {
                port = parsedPort;
            }

            await StartServer(port);
        }

        private static async Task StartServer(int port)
        {
            HttpListener listener = new HttpListener();
            listener.Prefixes.Add($"http://*:{port}/");
            listener.Start();

            Console.WriteLine($"Сервер запущен на порту {port}.");

            while (true)
            {
                HttpListenerContext context = await listener.GetContextAsync();
                HttpListenerRequest request = context.Request;
                HttpListenerResponse response = context.Response;

                Console.WriteLine($"Получен запрос: {request.Url}");

                byte[] buffer;

                if (File.Exists("index.html"))
                {
                    buffer = File.ReadAllBytes("index.html");
                    response.ContentType = "text/html";
                }
                else
                {
                    buffer = Encoding.UTF8.GetBytes("<h1>Файл index.html не найден</h1>");
                    response.StatusCode = (int)HttpStatusCode.NotFound;
                }

                response.ContentLength64 = buffer.Length;
                await response.OutputStream.WriteAsync(buffer, 0, buffer.Length);
                response.OutputStream.Close();
            }
        }
    }
}
