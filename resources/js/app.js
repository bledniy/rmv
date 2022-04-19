import {modals} from "./utils/modals";
import {slider} from "./utils/slider";
import {other} from "./utils/other";
import {navMenu} from "./utils/navMenu";
import {animations} from "./utils/animations";
import {scrollAnimation} from "./utils/scroll_animation";
import {chart} from "./utils/chart";
import {newsLoad} from "./utils/news";

document.addEventListener('DOMContentLoaded', function() {
	modals();
	slider();
	other();
	navMenu();
	animations();
	scrollAnimation();
	chart();
	newsLoad();
})
