// Import styles
import "../css/main.css";
import { initMenu } from "./menu";

const DOMContentLoaded = () => {
  initMenu();
};

document.addEventListener("DOMContentLoaded", DOMContentLoaded);
