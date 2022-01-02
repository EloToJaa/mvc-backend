import $ from "jquery";
import pageLoad from "./loadPages";
import { clickOnScroll, scrollNavbar, scrollUp } from "./scrolling";

$(() => {
	const headerTag = "header";
	const scrolledClass = "scrolled";
	$(headerTag).removeClass(scrolledClass);
	scrollNavbar(headerTag, scrolledClass);
	scrollUp(0);
	clickOnScroll();
	pageLoad();
});
