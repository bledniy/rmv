export const newsLoad = () => {
    const attributeName = 'data-load-news-url';
    const newsLoadMoreBtn = document.querySelector(`[${attributeName}]`);
    const newsPageWrap = document.querySelector('[data-news-pages-wrap]');
    if (!newsLoadMoreBtn || !newsPageWrap) {
        return;
    }
    newsLoadMoreBtn.addEventListener('click', (e) => {
        e.preventDefault()
        const url = newsLoadMoreBtn.getAttribute(attributeName)
        fetch(url)
            .then(async response => {
                const json = (await response.json());
                newsPageWrap.insertAdjacentHTML('beforeend', json.html)
                if (!json.nextPageUrl){
                    newsLoadMoreBtn.remove();
                }
                newsLoadMoreBtn.setAttribute(attributeName, json.nextPageUrl);
            })
    })


}