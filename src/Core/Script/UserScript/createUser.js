import { successSnackbar, errorSnackbar } from "../Utils/snackBar.js";
import { isNotValid, isValid } from "../Utils/checkInput.js";

const container = document.querySelector("#container-subscription");

/**
 * Handles the submission of the user creation form.
 *
 * This function prevents the default form submission, creates a new FormData object from the form,
 * sends a request to the server to create the user, and handles the response. If the creation is successful,
 * it hides the user creation form, displays the login form, and shows a success message. If there is an error,
 * it shows an error message.
 *
 * @param {Event} event - The form submission event.
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
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

/**
 * Hides the user creation form.
 *
 * This function animates the user creation form and then hides it.
 */
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

/**
 * Displays the login form.
 *
 * This function animates the login form and then shows it.
 */
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
