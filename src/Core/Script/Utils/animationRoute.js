import * as user from "../../../Core/Script/UserScript/logoutUser.js";

const animationMainTodoEntrance = () => {
  const el = document.querySelector("#main-content");
  anime({
    targets: el,
    keyframes: [
      { opacity: 0, translateX: -40 },
      { opacity: 1, translateX: 0 },
    ],
    duration: 500,
    easing: "easeInOutQuad",
  });
};

const animationMainTodoOut = () => {
  const el = document.querySelector("#main-content");
  const logout = document.querySelector("#logout");

  logout.addEventListener("click", (e) => {
    const logout = user.logout();
    if (!!logout) {
      anime({
        targets: el,
        keyframes: [
          { opacity: 1, translateX: 0 },
          { opacity: 0, translateX: 40 },
        ],
        duration: 200,
        easing: "easeInOutQuad",
      });
      setTimeout(() => {
        window.location.href = "../../../index.php";
      }, 500);
    }
  });
};

animationMainTodoEntrance();
animationMainTodoOut();
