var spans = document.querySelectorAll("div.methods_tab span");
var forms = document.querySelectorAll("div.form_wrap");
spans.forEach((v, k) => {
    v.onclick = function() {
        spans.forEach((v) => {
            v.className = "";
        });
        forms.forEach((v) => {
            v.className = "form_wrap";
        });
        v.className = "active";
        forms[k].className = "form_wrap active";
    }
});
