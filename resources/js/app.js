'use strict';

let isMobile = {
	Android: function() {return navigator.userAgent.match(/Android/i);},
	BlackBerry: function() {return navigator.userAgent.match(/BlackBerry/i);},
	iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},
	Opera: function() {return navigator.userAgent.match(/Opera Mini/i);},
	Windows: function() {return navigator.userAgent.match(/IEMobile/i);},
	any: function() {return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());}
};
 
const body = document.querySelector('body');
const arrow = document.querySelectorAll('.arrow'); // creates array(NodeList) with elements of all span.arrow

if (isMobile.any()) {
   body.classList.add('touch');

   arrow.forEach(function (arrowElement) {
      let thisArrow = arrowElement;
      let subMenu = arrowElement.nextElementSibling;
      let thisLink = arrowElement.previousElementSibling;

      thisLink.classList.add('parent'); // add rigth margin for <a>
      arrowElement.addEventListener('click', function() {
         subMenu.classList.toggle('open'); // display sub-menu
         thisArrow.classList.toggle('active') // rotate arrow
      })
   });

} else {
   body.classList.add('mouse')

   arrow.forEach(function (arrowElement) {
      let thisLink = arrowElement.previousElementSibling;
      thisLink.classList.add('parent'); // add rigth margin 
   });

}



// Burger Menu

let btnBurger = document.querySelector('.menu-burger');
let menu = btnBurger.nextElementSibling;
btnBurger.addEventListener('click', function() {
   btnBurger.classList.toggle('burger-active')
   menu.classList.toggle('menu-active')
})


// Current link 
const activePage = window.location.href;
const navbar = document.querySelector('.menu');

const navLinks = document
  .querySelectorAll("a.menu__link, a.sub-menu__link")
  .forEach((link) => {
     if (activePage === link.href) {
      link.parentElement.classList.add('current-li');
      const mainMenuItem = link.parentElement.parentElement.parentElement;
      if (mainMenuItem !== navbar) mainMenuItem.classList.add('current-li');
     }
  });




































































// if (isMobile.any()) {
//    body.classList.add('touch');

//    for (let i = 0; i < arrow.length; i++) {
//       let thisLink = arrow[i].previousElementSibling;
//       let subMenu = arrow[i].nextElementSibling;
//       let thisArrow = arrow[i];

//       thisLink.classList.add('parent');
//       arrow[i].addEventListener('click', function() {
//          subMenu.classList.toggle('open');
//          thisArrow.classList.toggle('active')
//       })
//    }
// } else {
//    body.classList.add('mouse')

//    for (let i = 0; i < arrow.length; i++) {
//       let thisLink = arrow[i].previousElementSibling;
//       let subMenu = arrow[i].nextElementSibling;
//       let thisArrow = arrow[i];

//       thisLink.classList.add('parent');
//       arrow[i].addEventListener('click', function() {
//          subMenu.classList.toggle('open');
//          thisArrow.classList.toggle('active')
//       })
//    }
// }







