import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../Utils/snackBar.js";
import { isNotValid, isValid } from "../Utils/checkInput.js";

const container = document.querySelector("#container-subscription");

const handleSubmit = async (event) => {
  event.preventDefault();
  const formData = new FormData(event.target);
  const response = await fetch(
    "../../../Core/Usecase/User/Create-user-usecase.php",
    { method: "POST", body: formData },
  );
  const data = await response.json();

  if (!!data.success) {
    const message = `User ${data.message} 'a bien ètè crèè !`;
    successSnackbar(message);
    hiddenForm();
    displayLoginForm();
  } else {
    errorSnackbar(data.message);
  }
};

document
  .querySelector("#form-create-user")
  .addEventListener("submit", handleSubmit);

const hiddenForm = () => {
  anime({
    targets: container,
    keyframes: [
      { translateY: 0, opacity: 1 },
      { translateY: 0, opacity: 0 },
    ],
    duration: 500,
    easing: "easeInOutQuad",
  });
};

const displayLoginForm = () => {
  const loginForm = document.querySelector("#container-conn");
  anime({
    targets: loginForm,
    keyframes: [
      {
        opacity: 0,
        offset: 0,
      },
      {
        opacity: 0.8,
        translateX: "50%",
        offset: 0.8,
      },
      { opacity: 0.8, offset: 0.8 },
      {
        zIndex: 999,
        opacity: 1,
        offset: 1,
      },
    ],
    duration: 900,
    easing: "easeInOutQuad",
  });
};

document.querySelector("#login-create").addEventListener("input", (event) => {
  const hint = document.querySelector("#error-login");
  const login = event.target.value;
  if (login.length < 3 || login.length > 40) isNotValid(event.target, hint);
  else isValid(event.target, hint);
});

document
  .querySelector("#password-create")
  .addEventListener("input", (event) => {
    const hint = document.querySelector("#error-password");
    const password = event.target.value;
    const passwordValid = password.match(/^(?=.*[A-Z])(?=.*[!@#$&*])(.{10,})$/);

    if (!passwordValid) isNotValid(event.target, hint);
    else isValid(event.target, hint);
  });
