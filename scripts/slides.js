function slides_show() {
    var images = document.querySelectorAll(".slides img");
    var dots   = document.querySelectorAll(".dots span");

    var index  = 0;
    setInterval(() => {
        index = (index + 1) % images.length;
        images.forEach((v, k) => {
            v.className       = "";
            dots[k].className = "dot";
        })
        images[index].className = "active";
        dots[index].className   = "dot active";
    }, 2000);

    dots.forEach((v, k) => {
        v.onclick = () => {
            images.forEach((value, key) => {
                value.className       = "";
                dots[key].className = "dot";
            })
            v.className = "dot active";
            index = k;
            images[k].className = "active";
        }
    })
}

slides_show();
