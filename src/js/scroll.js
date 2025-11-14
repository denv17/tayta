import { observeIntersection } from "./utilities";

const SCROLL_SPY_OPTIONS = {
  root: null,
  rootMargin: "-20% 0px -70% 0px",
  threshold: 0,
};

/**
 * Smooth scroll to element
 * @returns {boolean} Success
 *
 * @example
 * smoothScrollTo('#section');
 * smoothScrollTo(element, { block: 'center' });
 */
export const smoothScrollTo = (target, options = {}) => {
  const element =
    typeof target === "string" ? document.querySelector(target) : target;

  if (!element) return false;

  const defaultOptions = {
    behavior: "smooth",
    block: "start",
    inline: "nearest",
  };

  element.scrollIntoView({ ...defaultOptions, ...options });
  return true;
};

/**
 * Setup scroll spy for navigation links
 * @returns {Function} Cleanup function
 *
 * @example
 * setupScrollSpy(menuLinks, link => link.classList.add('active'));
 * setupScrollSpy(links, onActivate, { rootMargin: "-10% 0px -80% 0px" });
 */
export const setupScrollSpy = (links, onActivate, options = {}) => {
  if (!links || links.length === 0) return () => {};

  const sections = Array.from(links)
    .map(link => {
      const href = link.getAttribute("href");
      if (href?.startsWith("#")) {
        return document.getElementById(href.substring(1));
      }
      return null;
    })
    .filter(Boolean);

  if (sections.length === 0) return () => {};

  const handleSectionVisible = section => {
    const targetLink = Array.from(links).find(
      link => link.getAttribute("href") === `#${section.id}`
    );
    if (targetLink) onActivate(targetLink);
  };

  const observerOptions = { ...SCROLL_SPY_OPTIONS, ...options };

  return observeIntersection(sections, handleSectionVisible, observerOptions);
};

/**
 * Setup smooth scroll for all anchor links
 * @returns {Function} Cleanup function
 *
 * @example
 * setupSmoothScroll();
 * setupSmoothScroll('a[href^="#"]', (link, href) => console.log(href));
 */
export const setupSmoothScroll = (
  selector = 'a[href^="#"]',
  beforeScroll = null,
  scrollOptions = {}
) => {
  const links = document.querySelectorAll(selector);

  const handleClick = e => {
    const link = e.currentTarget;
    const href = link.getAttribute("href");

    if (href?.startsWith("#") && href !== "#") {
      e.preventDefault();

      if (beforeScroll) beforeScroll(link, href);

      smoothScrollTo(href, scrollOptions);
    }
  };

  links.forEach(link => {
    link.addEventListener("click", handleClick);
  });

  return () => {
    links.forEach(link => {
      link.removeEventListener("click", handleClick);
    });
  };
};

/**
 * Check if element is in viewport
 *
 * @example
 * if (isInViewport(element)) element.classList.add('visible');
 */
export const isInViewport = (element, offset = 0) => {
  if (!element) return false;

  const rect = element.getBoundingClientRect();
  return (
    rect.top >= -offset &&
    rect.left >= -offset &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) + offset &&
    rect.right <=
      (window.innerWidth || document.documentElement.clientWidth) + offset
  );
};

/**
 * Scroll to top of page
 *
 * @example
 * scrollToTop();
 * scrollToTop({ behavior: 'auto' });
 */
export const scrollToTop = (options = {}) => {
  const defaultOptions = {
    top: 0,
    behavior: "smooth",
  };

  window.scrollTo({ ...defaultOptions, ...options });
};
