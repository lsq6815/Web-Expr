var eye = document.getElementById('eye');
eye.onclick = function() {
    var item = document.querySelector('div#password > input');
    if (eye.classList.contains('eye_close')) {
        eye.className = "input_eye eye_open";
        item.setAttribute('type', 'text');
    }
    else {
        eye.className = "input_eye eye_close";
        item.setAttribute('type', 'password');
    }
}
