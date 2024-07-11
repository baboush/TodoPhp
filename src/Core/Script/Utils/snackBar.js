const snackbar = document.querySelector("#snackbar");

export const successSnackbar = (message) => {
  openSnackbar();
  snackbar.textContent += `${message}`;
  snackbar.classList.add("bg-green-700", "visible", "z-50");
  closeSnackbar();
};

export const errorSnackbar = (message) => {
  openSnackbar();
  snackbar.textContent += `${message}`;
  snackbar.classList.add("bg-red-700", "visible", "z-50");
  setTimeout(() => {
    closeSnackbar();
    window.location.reload();
  }, 3000);
};

const closeSnackbar = () => {
  setTimeout(() => {
    anime({
      targets: snackbar,
      keyframes: [
        { translateY: 0, opacity: 1 },
        { translateY: 0, opacity: 0, display: "none" },
      ],
      duration: 500,
      easing: "easeInOutQuad",
      fill: "forwards",
    });
  }, 3500);
};

export const openSnackbar = () => {
  anime({
    targets: snackbar,
    keyframes: [
      { translateY: 0, opacity: 0 },
      { translateY: 0, opacity: 1 },
    ],
    duration: 500,
    easing: "easeInOutQuad",
  });
};
