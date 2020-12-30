document.querySelector("input[name='lookup']").onkeyup = function() {
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
                // document.getElementById('info').innerHTML = "id: " + json.id + "<br/>username: " + json.username + "<br/>phone: " + json.phone;
                document.getElementById("td1").innerHTML = json.id;
                document.getElementById("td2").innerHTML = json.username;
                document.getElementById("td3").innerHTML = json.phone;
            }
            else {
                // document.getElementById('info').innerHTML = "No info for: " + request.username;
                document.getElementById("td1").innerHTML = "NULL";
                document.getElementById("td2").innerHTML = "NULL";
                document.getElementById("td3").innerHTML = "NULL";
            }
        }
    }

    // send data as JSON
    xmlhttp.open("POST", "./lookup.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(JSON.stringify(request));
}
