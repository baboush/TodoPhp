const toggleMenuMobile = () => {
  const menu = document.querySelector("#list-action");
  menu.classList.toggle("hidden");
};

document
  .querySelector("#mobile-menu")
  .addEventListener("click", toggleMenuMobile);
