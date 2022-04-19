import {Chart} from "chart.js/dist/chart.min"
export const chart = () =>{

    let initialChart = (idName, dataOptions, titleLabels) => {
        const BarChart = document.getElementById(idName)
        new Chart(BarChart, {
            type: 'bar',
            data:{
                labels: ["Одесса 1997", "Николаев 2008", "Кропивницкий 2010", "Херсон 2017", "Кривой Рог 2018", "Запорожье 2019", "Днепр 2021"],
                datasets: [
                    {
                        label: titleLabels,
                        backgroundColor: ["#2c287d"],
                        data: dataOptions
                    }
                ]
            } ,
            options: {
                plugins:{
                    legend: {display: false}},
                title: {
                    display: false,
                    text: 'Predicted'
                },
                animation: {
                    duration: 1500,
                    easing: 'ease',
                    tension: {
                        duration: 1000,
                        easing: 'easy',
                        from: 1,
                        to: 0,
                        loop: false,
                    }
                },
            }

        });
    }
    const dataForMeters = [5, 15, 21, 25, 28, 31, 38];
    const dataForTon = [7, 17, 24, 27, 32, 35, 40];
    if (document.getElementById('bar-meters')){
        initialChart("bar-meters", dataForMeters, "Квадратные метры")
    }
    if (document.getElementById('bar-ton')){
        initialChart("bar-ton", dataForTon, "Тонны в месяц")
    }
}