
document.addEventListener('DOMContentLoaded', function () {
    chrome.tabs.executeScript( {code: "window.getSelection().toString();"}, 
    function(selection) {
        document.getElementById("output").innerHTML = selection[0];

        chrome.tabs.query({currentWindow: true, active: true},

            function(tabs, selection){
                chrome.tabs.sendMessage(tabs[0].id, selection[0])
            })
    });

}, false)