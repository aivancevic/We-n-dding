let countDownDate = new Date("Jan 1, 2022 00:00:00").getTime();

let x = setInterval( () => {
    let now = new Date().getTime();
    let distance = countDownDate - now;
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60 )) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("launch").innerHTML = days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';
    if (distance < 0){
        clearInterval(x);
        document.getElementById("launch").innerHTML = "Weˇare launching!";
    }
})