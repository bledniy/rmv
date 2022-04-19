export const navMenu =() =>{
    const navOpenButt = document.getElementById("nav-menu");
    const navModalMenu = document.querySelector(".header__mob__modal");
    const headreWrap = document.querySelector(".header > .container")
    const body = document.querySelector("body")
    const link = document.querySelectorAll(".link")
    
    navOpenButt.addEventListener("click", () =>{
        body.classList.toggle("lock-burger")
        navOpenButt.classList.toggle('nav-atc')
        navModalMenu.classList.toggle('nav-modal-act')
        headreWrap.classList.toggle('mod')
    })
    link.forEach(button => {
        button.addEventListener('click', (e) => {
            body.classList.remove("lock-burger");
            navModalMenu.classList.remove('nav-modal-act');
            navOpenButt.classList.remove('nav-atc')
        });
    })

    
}