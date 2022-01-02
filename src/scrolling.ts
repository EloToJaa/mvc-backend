import $ from "jquery";

export const scrollNavbar = (navbarTag: string, scrollTag: string) => {
	$(window).on("scroll", () => {
		const scroll = $(window).scrollTop();
		const width = $(window).width();
		if (scroll > 0) {
			$(navbarTag).addClass(scrollTag);
		} else if (width > 650) {
			$(navbarTag).removeClass(scrollTag);
		}
	});
};

export const scrollUp = (y: number) => {
	$("html, body").animate(
		{
			scrollTop: y,
		},
		0
	);
};

export const clickOnScroll = () => {
	const scrollTag = ".scroll_down";
	$(scrollTag).on("click", () => {
		$("html, body").animate(
			{
				scrollTop: 100,
			},
			1000
		);
	});
};
