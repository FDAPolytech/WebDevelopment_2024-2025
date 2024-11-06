package main

import (
	"flag"
	"fmt"
	"log"
	"net/http"
	"os"
	"path/filepath"
)

func main() {
	// -port=desired port
	port := flag.String("port", "8888", "Port to run the web server on")
	flag.Parse()

	execPath, err := os.Executable()
	if err != nil {
		log.Fatalf("Не удалось определить путь к исполняемому файлу: %v", err)
	}
	indexPath := filepath.Join(filepath.Dir(execPath), "index.html")

	http.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		if r.URL.Path == "/" {
			http.ServeFile(w, r, indexPath)
		} else {
			http.NotFound(w, r)
		}
	})

	address := fmt.Sprintf(":%s", *port)
	fmt.Printf("Сервер запущен на порту %s. Ожидание подключений...\n", *port)
	if err := http.ListenAndServe(address, nil); err != nil {
		log.Fatalf("Ошибка запуска сервера: %v", err)
	}
}
