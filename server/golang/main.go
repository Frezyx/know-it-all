package main

// NOW NOT USED

func main() {}

// import (
// 	"log"
// 	"net/http"

// 	"github.com/gorilla/mux"
// )

// func getExplanation(w http.ResponseWriter, r *http.Request) {
// 	w.Header().Set("Content-Type", "application/json")
// 	params := mux.Vars(r)
// 	word := params["word"]
// 	print(word)
// }

// func main() {
// 	r := mux.NewRouter()
// 	log.Fatal(http.ListenAndServe(":8000", r))
// 	r.HandleFunc("/check/{word}", getExplanation).Methods("GET")
// 	print("Запустились тут 8000")
// }
