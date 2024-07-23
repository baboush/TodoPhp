import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../Utils/snackBar.js";
import { isNotValid, isValid } from "../Utils/checkInput.js";

/**
 * Handles the submission of the user update form.
 *
 * This function prevents the default form submission, creates a new FormData object from the form,
 * sends a request to the server to update the user, and handles the response. If the update is successful,
 * it hides the user update form and shows a success message. If there is an error,
 * it hides the user update form and shows an error message.
 *
 * @param {Event} event - The form submission event.
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
const handleSubmit = async (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  const response = await fetch(
    "../../../Core/Usecase/User/Update-usecase.php",
    {
      method: "POST",
      body: formData,
    },
  );
  const data = await response.json();
  openSnackbar();
  if (data.success) {
    const message = `Mise à jour rèussie !`;
    successSnackbar(message);
    closeForm();
  } else {
    errorSnackbar(data.message);
    closeForm();
  }
};

/**
 * Shows the user update form.
 *
 * This function toggles the visibility of the user update form.
 */
const showForm = () => {
  const form = document.querySelector("#container-update");
  form.classList.toggle("hidden");
  form.classList.toggle("opacity-0");
  form.classList.toggle("z-50");
};

/**
 * Hides the user update form.
 *
 * This function toggles the visibility of the user update form.
 */
const closeForm = () => {
  const form = document.querySelector("#container-update");
  form.classList.toggle("hidden");
  form.classList.toggle("opacity-0");
  form.classList.toggle("z-50");
};

document.querySelector("#input-update-login").addEventListener("input", (e) => {
  if (e.target.value.length < 3 || e.target.value.length > 40)
    isNotValid(e.target, document.querySelector("#hint-update-login"));
  else isValid(e.target, document.querySelector("#hint-update-login"));
});

document
  .querySelector("#input-update-password")
  .addEventListener("input", (e) => {
    if (e.target.value.length < 3 || e.target.value.length > 40)
      isNotValid(e.target, document.querySelector("#hint-update-password"));
    else isValid(e.target, document.querySelector("#hint-update-password"));
  });

document
  .querySelector("#form-update-user")
  .addEventListener("submit", handleSubmit);

document
  .querySelector("#toggle-update-user")
  .addEventListener("click", showForm);

document
  .querySelector("#cancel-update-user")
  .addEventListener("click", closeForm);
