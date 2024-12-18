package main

import (
	"context"
	"errors"
	"log"
	"net/http"
	"os"
	"os/signal"
	"syscall"
	"time"
)

func main() {
	port := os.Getenv("PORT")
	if port == "" {
		port = "8080"
	}

	server := &http.Server{
		Addr:         ":" + port,
		WriteTimeout: 10 * time.Second,
		ReadTimeout:  10 * time.Second,
		IdleTimeout:  10 * time.Second,
		Handler:      http.FileServer(http.Dir("./")),
	}

	go func() {
		log.Print("starting serving new connections...")
		if err := server.ListenAndServe(); !errors.Is(err, http.ErrServerClosed) {
			log.Print("HTTP server error", "err", err)
			os.Exit(-1)
		}
		log.Print("stopped serving new connections")
	}()

	sigChan := make(chan os.Signal, 1)
	signal.Notify(sigChan, syscall.SIGINT, syscall.SIGTERM)
	<-sigChan

	shutdownCtx, shutdownRelease := context.WithTimeout(context.Background(), 10*time.Second)
	defer shutdownRelease()

	if err := server.Shutdown(shutdownCtx); err != nil {
		log.Print("server shutdown error", "err", err)
	}

	log.Print("server shutdown")
}
