package main

import (
	"log"
	"net/http"

	"github.com/gorilla/mux"
)

func getExplanation(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	params := mux.Vars(r)
	word := params["word"]
	// getResult(word)
	print(word)
}

// func getResult(word) {
// 	resp, err := http.Get("https://google.com/" + word)
// 	if err != nil {
// 		fmt.Println(err)
// 		return
// 	}
// 	defer resp.Body.Close()
// 	io.Copy(os.Stdout, resp.Body)
// }

func main() {
	r := mux.NewRouter()
	log.Fatal(http.ListenAndServe(":8000", r))
	r.HandleFunc("/check/{word}", getExplanation).Methods("GET")
	print("Запустились тут 8000")
}
