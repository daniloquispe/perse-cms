import Splide from "@splidejs/splide";

if (document.querySelector('.marquee') !== null)
	new Splide('.marquee', {autoplay: true, type: 'loop', arrows: false, pagination: false}).mount();
