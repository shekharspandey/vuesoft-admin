// Js For Testimonial Slider
const secondAnimateSlide = document.querySelector('.animate-slide');
const parentContainer = secondAnimateSlide.parentNode;

for (let i = 0; i < 3; i++) {
    const clonedDiv = secondAnimateSlide.cloneNode(true);
    parentContainer.appendChild(clonedDiv);
}
