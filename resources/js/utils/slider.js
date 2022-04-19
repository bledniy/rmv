import $ from "jquery";
import "slick-carousel/slick/slick";

export const slider = ()=> {
    const initialSlider = (className, slickOptions) => {
        var $slider = $(className);

        if ($slider.length) {
            var currentSlide;
            var slidesCount;
            var sliderCounter = document.createElement('div');
            sliderCounter.classList.add('slider__counter');

            var updateSliderCounter = function (slick, currentIndex) {
                currentSlide = slick.slickCurrentSlide() + 1;
                slidesCount = slick.slideCount;
                $(sliderCounter).text(currentSlide + '/' + slidesCount)
            };

            $slider.on('init', function (event, slick) {
                $slider.append(sliderCounter);
                updateSliderCounter(slick);
            });

            $slider.on('afterChange', function (event, slick, currentSlide) {
                updateSliderCounter(slick, currentSlide);
            });

            $slider.slick(slickOptions);
        }
    }

    const optionsForTeam = {
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            },
                        },
                        {

                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            },
                        }
                    ]
                },
            }
        ]
    }
    const optionsForNews = {
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                },
            },
            {

                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                },
            }
        ]
    }

    initialSlider('.team__slider', optionsForTeam);
    initialSlider('.news__slider', optionsForNews);
}