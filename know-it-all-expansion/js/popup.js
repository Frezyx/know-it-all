
document.addEventListener('DOMContentLoaded', function () {
    chrome.tabs.executeScript( {code: "window.getSelection().toString();"}, 
    function(selection) {
        var xhr = new XMLHttpRequest();
            xhr.open("GET", 'http://10.4.148.13/know-it-all/server/php/search.php?word='+selection); // async=true
            xhr.onload = function (e) {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("output").innerHTML = xhr.responseText;// responseText -- текст ответа.
                    document.getElementById("configLoger").innerHTML = 'http://10.4.148.13/know-it-all/server/php/search.php?word='+selection;
                }
                else{
                    document.getElementById("output").innerHTML = "Что-то не так";
                }
            };
            xhr.send(null);
    });

}, false)