/** @format */
import $ from "jquery";

export const animations = () => {

    setTimeout(()=>{
    if ($("#about-us").length) {
        function increaseAnimation(startingAnimation, firstValue, secondValue, animationValue) {
            const coverageBlock = $(startingAnimation);
            const animationClass = $(animationValue);
            let blockStatus = true;
                $(window).scroll(function () {
                    let scrollEvent =
                        $(window).scrollTop() >
                        coverageBlock.position().top - $(window).height();

                    if (scrollEvent && blockStatus) {
                        blockStatus = false;

                        $({numberValue: firstValue}).animate(
                            {numberValue: secondValue},
                            {
                                duration: 3000,
                                easing: "linear",
                                step: function (val) {
                                    $(animationClass).html(Math.ceil(val));
                                },
                            }
                        );
                    }
                });
        }

        function fastAnimation(firstValue, secondValue, animationValue) {
            setTimeout(()=>{
            const animation_class = $(animationValue);
            $({numberValue: firstValue}).animate(
                {numberValue: secondValue},
                {
                    duration: 3000,
                    easing: "linear",

                    step: function (val) {
                        $(animation_class).html(Math.ceil(val));
                    },
                }
            );
            }, 900)
        }

        fastAnimation(2022, 1997, ".year-value");
        fastAnimation(0, 6, ".regional-value");
        fastAnimation(0, 11500, ".points-value");
        fastAnimation(0, 3000, ".skuv-value");
        fastAnimation(0, 100, ".brands-value");
        fastAnimation(0, 16, ".depart-value");

        increaseAnimation(".coverage-map", 0, 94, ".coverage-value");
        increaseAnimation(".coverage-map", 0, 48, ".goals-value");
        increaseAnimation(".coverage-map", 0, 27, ".region-value");

        increaseAnimation(".logistics", 0, 7, ".rc-value");
        increaseAnimation(".logistics", 0, 155, ".people-value");
        increaseAnimation(".logistics", 0, 130, ".auto-value");
        increaseAnimation(".logistics", 0, 100, ".wms-value");
        increaseAnimation(".logistics", 0, 3000, ".sku-value");
        increaseAnimation(".logistics", 0, 11500, ".place-value");
        increaseAnimation(".logistics", 0, 22100, ".forgive-value");
        increaseAnimation(".logistics", 0, 2500, ".ton-value");
        increaseAnimation(".logistics", 0, 37, ".partners-value");
    }
    },800)

};
