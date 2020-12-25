document.querySelector("div.form div#code a#get_code ").onclick = function() {
    // check if phone number is given correct
   var sms_request = {
        phone: document.querySelector("div.form div#phone input[name='phone']").value
    }
    var pattern = /^\d{11}$/

    // if phone number is of correct format
    if (pattern.test(sms_request.phone)) {
        // send request to server via JSON
        document.getElementById('show_error').style.opacity = 0;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // parse response as JSON
                var json = JSON.parse(this.responseText);
                // console.log(json);
                if (json.status) {
                    document.getElementById('show_error').innerText = "短信已发向：" + sms_request.phone;
                    document.getElementById('show_error').style.opacity = 1;
                    setTimeout(function(){
                        document.getElementById('show_error').innerText = "验证码已过时";
                        document.getElementById('show_error').style.opacity = 1;

                    },
                    10000); // set sms code timeout here, unit is ms;
                }
            }
        };

        // send data as JSON
        xmlhttp.open("POST", "./validate_phone.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/json");
        xmlhttp.send(JSON.stringify(sms_request));
    }
    else {
        document.getElementById('show_error').innerText = "手机号格式不正确";
        document.getElementById('show_error').style.opacity = 1;
    }
}
