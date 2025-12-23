// Import styles
import "../css/main.css";
import { initMenu } from "./menu";
import { initSlider } from "./slider";
import { initBowlBuilder } from "./bowl-builder";

const DOMContentLoaded = () => {
  initMenu();
  initSlider();
  initBowlBuilder();
};

document.addEventListener("DOMContentLoaded", DOMContentLoaded);
