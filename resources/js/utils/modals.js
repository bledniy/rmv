export const modals = () => {
    const body = document.querySelector("body")
    const allModals = document.querySelectorAll(".modal_bg")
    const navOpenButt = document.getElementById("nav-menu");
    const navModalMenu = document.querySelector(".header__mob__modal");
    const supportButt = document.querySelectorAll(".buttons-support");
    const sendDataButt = document.querySelectorAll(".send-data")
    const supportModal = document.getElementById("contact-modal");
    const thanksModal = document.getElementById("thanks");
    const closeSupportModal = document.querySelectorAll(".close-modal-support");
    const vacanciesModule = () => {
        const addCvButt = document.querySelectorAll("[data-vancancies-link]")
        const addCvModal = document.getElementById("cv-modal")
        const modalVacancyInput = document.getElementById("modal-vacancy-id")
        const closeCvModal = document.querySelector(".close-modal-cv")

        addCvButt.forEach(button => {
            button.addEventListener('click', (e) => {
                modalVacancyInput.value = e.target.getAttribute('data-vacancy-id');
                body.classList.toggle("lock");
                addCvModal.classList.toggle('active');
            });
        })
        closeCvModal.addEventListener("click", () => {
            body.classList.toggle("lock");
            addCvModal.classList.toggle('active');
        })
    }


    const newsModule = () => {
        const newsCardDataAttribute = 'data-modal-url';
        const newsModalCloseAttribute = 'data-close-news-modal';
        const mewsModal = document.getElementById("news-modal")
        const newsPageWrap = document.querySelector('[data-news-pages-wrap]');
        if (newsPageWrap) {
            newsPageWrap.addEventListener('click', (e) => {
                const newsCard = event.target.closest(`[${newsCardDataAttribute}]`);
                if (!newsCard) {
                    return false;
                }
                const url = newsCard.getAttribute(newsCardDataAttribute)
                fetch(url).then(async response => {
                    mewsModal.innerHTML = await response.json()
                    body.classList.toggle("lock");
                    mewsModal.classList.toggle('active');
                })
            })
        }
        if (mewsModal) {
            mewsModal.addEventListener('click', (e) => {
                if (e.target.matches(`[${newsModalCloseAttribute}]`)) {
                    body.classList.toggle("lock");
                    mewsModal.classList.toggle('active');
                }
            })
        }
    }



    sendDataButt.forEach(button => {
        button.addEventListener('click', (e) => {
            supportModal.classList.remove('active');
            thanksModal.classList.toggle('active');
        });
    })
    supportButt.forEach(button => {
        button.addEventListener('click', (e) => {
            body.classList.add("lock");
            supportModal.classList.add('active');
            navModalMenu.classList.remove('nav-modal-act');
            navOpenButt.classList.remove('nav-atc');
        });
    })
    closeSupportModal.forEach(button => {
        button.addEventListener("click", () => {
            body.classList.remove("lock");
            supportModal.classList.remove('active');
            thanksModal.classList.remove('active');
        })
    })


    allModals.forEach(e => {
        e.addEventListener('click', e => {
            const {target, currentTarget} = e;
            if (currentTarget.className.includes('active') && target === currentTarget) {
                currentTarget.classList.remove('active');
                body.classList.remove('lock')
            }
        })
    })

    newsModule();
    vacanciesModule();
};
