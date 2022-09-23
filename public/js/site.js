// PAGE TOUS LES ARTICLES : BOUTON LIRE

let boite = document.querySelectorAll(".card");

boite.forEach(boi => {
    boi.addEventListener("mouseenter", function() {
        // boi.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
        boi.style.boxShadow = "0 8px 16px 0 rgba(0,0,0,0.2)";
        let show = boi.children[1];
        show.style.visibility = 'visible';
    });

    boi.addEventListener("mouseleave", function() {
        // boi.style.backgroundColor = "initial";
        boi.style.boxShadow = "0 4px 8px 0 rgba(0,0,0,0.2)";
        let show = boi.children[1];
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