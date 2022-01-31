function responsiveToggle() {
    var navbarContainer = document.getElementById("responsive");
    if (navbarContainer.className === "navbar") {
        navbarContainer.style.display = "initial";
        navbarContainer.className += " turnOn";
    } else {
        navbarContainer.style.display = "none";
        navbarContainer.className = "navbar";
    }
}

const navbar = document.querySelector('.navbar-container');

window.onscroll = () => {
    let distanceTop = window.scrollY;
    if(distanceTop >= 100){
        navbar.classList.add('opacity-active');
    }
    else{
        navbar.classList.remove('opacity-active');
    }
}