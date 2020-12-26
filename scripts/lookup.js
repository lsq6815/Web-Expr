document.querySelector("input[name='username']").onkeyup = function() {
    var request = {
        username: this.value
    };
    // console.log(request);
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var json = JSON.parse(this.responseText);
            console.log(json);
            if (json.status) {
                document.getElementById('info').innerHTML = "id: " + json.id + "<br/>username: " + json.username + "<br/>phone: " + json.phone;
            }
            else {
                document.getElementById('info').innerHTML = "No info for: " + request.username;
            }
        }
    }

    // send data as JSON
    xmlhttp.open("POST", "./lookup.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(JSON.stringify(request));
}
