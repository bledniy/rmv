import AOS from 'aos';
import 'aos/dist/aos.css';
export const scrollAnimation = () => {
    setTimeout(()=>{
    AOS.init({

        duration: 700,
        easing: "cubic-bezier(0.4, 0, 0.2, 1)",
        debounceDelay: 50,
        throttleDelay: 99,
        delay: 10000,
        once: true
    });
    },2150)
}