/**
 * Gallery Slider
 * CSS-based slider with scroll-snap and JavaScript navigation
 */

import { observeIntersection } from "./utilities";

export const initSlider = () => {
  const sliders = document.querySelectorAll("[data-gallery-slider]");

  sliders.forEach(slider => {
    const slides = slider.querySelectorAll("[data-gallery-slide]");
    const prevButton = slider.parentElement.querySelector("[data-slider-prev]");
    const nextButton = slider.parentElement.querySelector("[data-slider-next]");

    if (!slides.length || !prevButton || !nextButton) return;

    let currentIndex = 0;

    const scrollToSlide = index => {
      const targetSlide = slides[index];
      if (targetSlide) {
        targetSlide.scrollIntoView({
          behavior: "smooth",
          block: "nearest",
          inline: "start",
        });
        currentIndex = index;
      }
    };

    const goToNext = () => {
      const nextIndex =
        currentIndex + 1 >= slides.length ? 0 : currentIndex + 1;
      scrollToSlide(nextIndex);
    };

    const goToPrev = () => {
      const prevIndex =
        currentIndex - 1 < 0 ? slides.length - 1 : currentIndex - 1;
      scrollToSlide(prevIndex);
    };

    prevButton.addEventListener("click", goToPrev);
    nextButton.addEventListener("click", goToNext);

    // Update current index on scroll
    observeIntersection(
      slides,
      slide => {
        currentIndex = Array.from(slides).indexOf(slide);
      },
      {
        root: slider,
        threshold: 0.5,
      }
    );
  });
};
