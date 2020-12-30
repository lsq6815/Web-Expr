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
                document.getElementById('show_error').style.opacity = 0;
                // jamp to login page with given token
                document.location.assign(document.location.origin + '/Web-Expr/login.php?' + "username=" + login.username + "&token=" + json.token);
            }
        }
    };

    // send data as JSON
    xmlhttp.open("POST", "./validate.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(JSON.stringify(login));
}
