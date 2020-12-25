document.querySelector("form#pwd_login a.login_button").onclick = function() {
    // get user input, form it as JSON
    var login = {
        username: document.querySelector("form#pwd_login input[name='username']").value,
        password: document.querySelector("form#pwd_login input[name='password']").value
    };

    var xmlhttp = new XMLHttpRequest();
    // callback
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // parse response as JSON
            var json = JSON.parse(this.responseText);
            console.log(json);
            if (!json.status) {
                // if password is incorrect, show error tip
                document.getElementById('show_error').innerText = json.error;
                document.getElementById('show_error').style.opacity = 1;
            } else {
                // TODO: jamp to the success login page
                document.getElementById('show_error').style.opacity = 0;
                alert("Password correct");
            }
        }
    };

    // send data as JSON
    xmlhttp.open("POST", "./pwd_login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(JSON.stringify(login));
}
