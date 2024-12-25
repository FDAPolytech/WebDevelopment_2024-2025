package main

import (
    "fmt"
    "net/http"
)

func main() {
    port := "8888"

    http.Handle("/", http.FileServer(http.Dir(".")))

    fmt.Printf("Starting server on port %s...\n", port)
    err := http.ListenAndServe(":"+port, nil)
    if err != nil {
        fmt.Printf("Error starting server: %v\n", err)
        return
    }
}