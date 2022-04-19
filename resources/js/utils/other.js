import IMask from 'imask';

export const other = () => {
    window.addEventListener("load", () => {
        setTimeout(() => {
            const preloader = document.querySelector('[data-preloader]');
            if (!preloader){
                return;
            }
            document.body.classList.add('loaded');
            document.body.removeChild(preloader)
        }, 2150)
    })

    const elements = document.getElementsByClassName('imaskjs__input_tel');
    for (let i = 0; i < elements.length; i++) {
        new IMask(elements[i], {
            mask: '+{38}(000)000-00-00',
        });
    }
    const header = document.querySelector(".header")
    if (document.body.classList.contains("contacts_page")) {
        header.classList.toggle("contacts-mod")
    } else {
        header.classList.remove("contacts-mod")
    }
};
  