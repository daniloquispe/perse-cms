import Splide from "@splidejs/splide";

if (document.querySelector('.slider') !== null)
	new Splide('.slider', {autoplay: true, type: 'loop', pagination: false}).mount();
