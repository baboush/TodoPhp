import { errorSnackbar, successSnackbar } from "../Utils/snackBar.js";

/**
 * Handles the submission of the user login form.
 *
 * This function prevents the default form submission, creates a new FormData object from the form,
 * sends a request to the server to authenticate the user, and handles the response. If the authentication is successful,
 * it redirects the user to the index page and shows a success message. If there is an error,
 * it shows an error message.
 *
 * @param {Event} event - The form submission event.
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
const handleSubmit = async (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  const response = await fetch("../../../Core/Usecase/User/Login-usecase.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.json();
  if (data.success) {
    const message = `${data.message}, vous allez être redirigé !`;
    successSnackbar(message);
    setTimeout(() => {
      window.location.href = "../../../index.php";
    }, 3500);
  } else {
    errorSnackbar(data.message);
  }
};

document
  .querySelector("#form-login-user")
  .addEventListener("submit", handleSubmit);
