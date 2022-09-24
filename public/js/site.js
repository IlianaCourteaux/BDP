// PAGE TOUS LES ARTICLES : BOUTON LIRE

let card = document.querySelectorAll(".card");

card.forEach(crd => {
    crd.addEventListener("mouseenter", function() {
        crd.style.backgroundColor = "rgba(216, 173, 109, 30%)";
        crd.style.boxShadow = "0 8px 16px 0 rgba(0,0,0,0.4)";
        let show = crd.children[1];
        show.style.visibility = 'visible';
    });

    crd.addEventListener("mouseleave", function() {
        crd.style.backgroundColor = "initial";
        crd.style.boxShadow = "0 4px 8px 0 rgba(0,0,0,0.2)";
        let show = crd.children[1];
        show.style.visibility = 'hidden';
    });

});


// MENU HAMBURGER MEDIA QUERIES

const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

const navLink = document.querySelectorAll(".nav-link");

navLink.forEach(n => n.addEventListener("click", closeMenu));

function closeMenu() {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}