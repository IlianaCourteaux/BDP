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


// COMMENTAIRES

// let handleCommentForm = () => {
    
//     let commentForm = document.querySelector('form.commentform-class');

//     if (null === document.querySelector('form.commentform-class')) {
//         return;
//     }

//     commentForm.addEventListener('submit', async(e)) => {
//         e.preventDefault();

//         let response = await fetch('/ajax/comments', {
//             method: 'POST',
//             body: new FormData(e.target)
//         });

//         if (!response.ok){
//             return;
//         }

//         let json = await response.json();

//         if(json.code === 'COMMENT_ADDED_SUCCESSFULLY') {

//             let commentList = document.querySelector('.comment_list');
//             let commentCount = document.querySelector('.comment_count');
//             let commentMessage = document.querySelector('.comment_message');

//             commentList.insertAdjacentHTML('afterbegin', json.message);
//             commentList.lastElementChild.scrollIntoView();
//             commentCount.innerText = json.numberOfComments;
//             commentMessage.value = '';
//         }
//     }
// }


// MENU HAMBURGER MEDIA QUERIES

let hamburger = document.querySelector(".hamburger");
let navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

let navLink = document.querySelectorAll(".nav-link");

navLink.forEach(n => n.addEventListener("click", closeMenu));

function closeMenu() {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}