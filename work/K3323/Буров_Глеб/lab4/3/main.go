package main

import (
	"flag"
	"fmt"
	"io/ioutil"
	"net/http"
	"os"
)

func main() {
	// Разрешаем задавать порт через аргументы командной строки
	port := flag.String("port", "8888", "Port for the web server")
	flag.Parse()

	http.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		// Читаем содержимое index.html
		filePath := "index.html"
		content, err := ioutil.ReadFile(filePath)
		if err != nil {
			http.Error(w, "File not found", http.StatusNotFound)
			return
		}
		// Отправляем содержимое файла в ответе
		w.Header().Set("Content-Type", "text/html")
		w.Write(content)
	})

	// Запускаем сервер
	serverAddr := fmt.Sprintf(":%s", *port)
	fmt.Printf("Starting server on http://127.0.0.1%s\n", serverAddr)
	if err := http.ListenAndServe(serverAddr, nil); err != nil {
		fmt.Println("Error starting server:", err)
		os.Exit(1)
	}
}
