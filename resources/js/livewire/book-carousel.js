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
			},
			768: {
				perPage: 2,
			},
			1024: {
				perPage: 2,
			},
			1280: {
				perPage: 3,
			},
			1536: {
				perPage: 4,
			},
			1678: {
				perPage: 5,
			},
		}
	};

	new Splide(carousel, options).mount();
});
