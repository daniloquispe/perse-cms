import Splide from "@splidejs/splide";

let carousels = document.querySelectorAll('.book-carousel .splide');

carousels.forEach(function (carousel)
{
	new Splide(carousel, {gap: '1rem', perPage: 6, perMove: 1}).mount();
});
