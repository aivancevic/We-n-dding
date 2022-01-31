if (localStorage.getItem("cookieSeen") == "shown") {
    const cookiesDiv = document.querySelector(".cook");
    cookiesDiv.style.display = "none";
};

function fadeOut() {
localStorage.setItem("cookieSeen","shown")
var fadeTarget = document.querySelector(".cook");
var fadeEffect = setInterval(function () {
    if (!fadeTarget.style.opacity) {
        fadeTarget.style.opacity = 1;
    }
    if (fadeTarget.style.opacity > 0) {
        fadeTarget.style.opacity -= 0.1;
    } else {
        clearInterval(fadeEffect);
    }
}, 200);
}
document.querySelector(".cook").addEventListener('click', fadeOut);