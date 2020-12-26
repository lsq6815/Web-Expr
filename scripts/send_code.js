document.querySelector("a#sms").onclick = function() {
    // check if phone number is given correct
    var sms_request = {
        phone: document.querySelector("input[name='phone']").value,
    };
    var pattern = /^\d{11}$/

    // if phone number is of correct format
    if (pattern.test(sms_request.phone)) {
        // send request to server via JSON
        var xmlhttp = new XMLHttpRequest();
        var code = Math.floor(Math.random() * 10000); // limit to 4 dights
        
        // callback
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // parse response as JSON
                var json = JSON.parse(this.responseText);
                console.log(json);
                // if server has this phone
                if (json.errcode == 0) {
                     alert("短信已发向：" + sms_request.phone);
                    document.getElementById('apply').onclick = function(){
                        if (document.querySelector("input[name='code']").value == code) {
                            // document.querySelector("form").submit();
                            alert("OK");
                        } 
                    }
                }
                // if server hasn't this phone
                else {
                    alert(json.errmsg);
                }
            }
        };

        // send data as JSON
        xmlhttp.open("GET", "https://tianqiapi.com/api/sms?appid=84265617&appsecret=V9jv3QJ8&code=" + code + "&mobile=" + sms_request.phone, true);
        xmlhttp.send();
    }
    // if phone format is incorrect
    else {
        alert("手机号格式不正确");
    }
}
