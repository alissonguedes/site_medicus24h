// #slider
Splide.defaults = {
    type: 'loop',
    speed: 1000,
    perPage: 1,
    autoplay: true,
    wheel: false,
    arrows: false,
    pauseOnHover: false,
    pagination: false,
};
new Splide('#slider').mount();

// #slideshow
Splide.defaults = {
    type: 'loop',
    speed: 1000,
    perPage: 4,
    perMove: 4,
    autoplay: true,
    wheel: false,
    arrows: false,
    pauseOnHover: false,
    pagination: false,
    gap: '1rem',
};
new Splide('#slideshow').mount();