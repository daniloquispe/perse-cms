import Splide from "@splidejs/splide";

let carousels = document.querySelectorAll('.book-carousel .splide');

carousels.forEach(function (carousel)
{
	const options = {
		gap: '1rem',
		perMove: 1,
		perPage: 6,
		breakpoints: {
			640: {
				perPage: 2,
				arrows: false,
			},
			768: {
				perPage: 2,
				arrows: false,
			},
			1024: {
				perPage: 2,
				arrows: false,
			},
			1280: {
				perPage: 3,
				arrows: false,
			},
			1536: {
				perPage: 5,
			},
			1678: {
				perPage: 5,
			},
		}
	};

	new Splide(carousel, options).mount();
});
