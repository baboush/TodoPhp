import { errorSnackbar, successSnackbar } from "../Utils/snackBar.js";

/**
 * Handles the submission of the user deletion form.
 *
 * This function prevents the default form submission, creates a new FormData object from the form,
 * sends a request to the server to delete the user, and handles the response. If the deletion is successful,
 * it redirects the user to the index page and shows a success message. If there is an error,
 * it shows an error message.
 *
 * @param {Event} event - The form submission event.
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
const handleSubmit = async (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  const reaponse = await fetch(
    "../../../Core/Usecase/User/Delete-account-usecase.php",
    {
      method: "POST",
      body: formData,
    },
  );
  const data = await reaponse.json();

  if (data.success) {
    const message = `${data.message}`;
    successSnackbar(message);
    setTimeout(() => {
      window.location.href = "../../../index.php";
    }, 2500);
  } else {
    errorSnackbar(data.message);
  }
};

/**
 * Toggles the visibility of the user deletion form.
 *
 * This function toggles the 'invisible' and 'z-50' classes of the user deletion form,
 * effectively showing or hiding the form.
 */
const toggleFormDelete = () => {
  const form = document.querySelector("#form-delete-user");
  form.classList.toggle("invisible");
  form.classList.toggle("z-50");
};

document
  .querySelector("#form-delete-user")
  .addEventListener("submit", handleSubmit);
document
  .querySelector("#toggle-delete-user")
  .addEventListener("click", toggleFormDelete);
document
  .querySelector("#cancel-delete")
  .addEventListener("click", toggleFormDelete);
