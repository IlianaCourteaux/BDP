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