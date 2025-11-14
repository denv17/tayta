import { isMobile, onViewportChange } from "./utilities";
import { setupScrollSpy, smoothScrollTo } from "./scroll";

const isMenuOpen = menu => !menu.classList.contains("-translate-x-full");

const updateBodyScroll = isOpen => {
  document.body.style.overflow = isOpen ? "hidden" : "";
};

const toggleIcon = (button, isOpen) => {
  const hamburger = button?.querySelector('[data-icon="hamburger"]');
  const close = button?.querySelector('[data-icon="close"]');

  if (isOpen) {
    hamburger?.classList.add("hidden");
    close?.classList.remove("hidden");
  } else {
    hamburger?.classList.remove("hidden");
    close?.classList.add("hidden");
  }
};

const updateA11yAttributes = (button, menuLinks, isOpen) => {
  button?.setAttribute("aria-expanded", isOpen);

  menuLinks.forEach(link => {
    link.setAttribute("tabindex", isMobile() && !isOpen ? "-1" : "0");
  });
};

const toggleMenu = (menu, button, menuLinks) => {
  menu.classList.toggle("-translate-x-full");
  const isOpen = isMenuOpen(menu);

  if (isMobile()) updateBodyScroll(isOpen);
  toggleIcon(button, isOpen);
  updateA11yAttributes(button, menuLinks, isOpen);
};

const closeMenu = (menu, button, menuLinks) => {
  menu.classList.add("-translate-x-full");
  updateBodyScroll(false);
  toggleIcon(button, false);
  updateA11yAttributes(button, menuLinks, false);
};

const setActiveLink = (menuLinks, activeLink) => {
  menuLinks.forEach(link => {
    link.classList.remove("text-blue");
    link.classList.add("text-white");
  });

  if (activeLink) {
    activeLink.classList.remove("text-white");
    activeLink.classList.add("text-blue");
  }
};

export const initMenu = () => {
  const menuToggle = document.querySelector("[data-menu-toggle]");
  const menu = document.querySelector("[data-menu]");

  if (!menuToggle || !menu) return;

  const menuLinks = menu.querySelectorAll("a");

  updateA11yAttributes(menuToggle, menuLinks, false);

  menuToggle.addEventListener("click", () => {
    toggleMenu(menu, menuToggle, menuLinks);
  });

  menuLinks.forEach(link => {
    link.addEventListener("click", e => {
      const href = link.getAttribute("href");

      if (href?.startsWith("#")) {
        e.preventDefault();
        smoothScrollTo(href);
      }

      if (isMobile()) {
        closeMenu(menu, menuToggle, menuLinks);
      }
    });
  });

  const handleEscape = e => {
    if (e.key === "Escape" && isMobile() && isMenuOpen(menu)) {
      closeMenu(menu, menuToggle, menuLinks);
    }
  };

  document.addEventListener("keydown", handleEscape);

  const cleanupViewportListener = onViewportChange(({ isDesktop }) => {
    if (isDesktop) {
      if (isMenuOpen(menu)) closeMenu(menu, menuToggle, menuLinks);
      menuLinks.forEach(link => link.setAttribute("tabindex", "0"));
    }
  });

  const cleanupScrollSpy = setupScrollSpy(menuLinks, link => {
    setActiveLink(menuLinks, link);
  });

  return () => {
    document.removeEventListener("keydown", handleEscape);
    cleanupViewportListener();
    cleanupScrollSpy();
  };
};
