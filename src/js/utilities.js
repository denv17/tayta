export const BREAKPOINT_LG = 1024;

const mediaQuery = window.matchMedia(`(min-width: ${BREAKPOINT_LG}px)`);

export const isDesktop = () => mediaQuery.matches;

export const isMobile = () => !mediaQuery.matches;

/**
 * Listen for viewport changes between mobile and desktop
 * @returns {Function} Cleanup function
 */
export const onViewportChange = callback => {
  const handler = e => {
    callback({
      isDesktop: e.matches,
      isMobile: !e.matches,
      breakpoint: BREAKPOINT_LG,
    });
  };

  mediaQuery.addEventListener("change", handler);

  return () => {
    mediaQuery.removeEventListener("change", handler);
  };
};

/**
 * Create a generic Intersection Observer
 * @returns {Function} Cleanup function
 *
 * @example
 * observeIntersection(elements, el => el.classList.add('visible'), { threshold: 0.5 });
 */
export const observeIntersection = (elements, callback, options = {}) => {
  if (!elements || elements.length === 0) {
    return () => {};
  }

  const defaultOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0,
  };

  const observerOptions = { ...defaultOptions, ...options };

  const observerCallback = entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        callback(entry.target);
      }
    });
  };

  const observer = new IntersectionObserver(observerCallback, observerOptions);

  elements.forEach(element => {
    if (element) observer.observe(element);
  });

  return () => {
    observer.disconnect();
  };
};
