import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../Utils/snackBar.js";
import { isNotValid, isValid } from "../Utils/checkInput.js";

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
  const data = response.json();
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

const showForm = () => {
  const form = document.querySelector("#container-update");
  form.classList.toggle("invisible");
  anime({
    targets: form,
    keyframes: [
      { opacity: 0, zoom: 0 },
      { opacity: 1, zoom: 1, zIndex: 10 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
  });
};

const closeForm = () => {
  const form = document.querySelector("#container-update");
  anime({
    targets: form,
    keyframes: [
      { opacity: 1, zoom: 1 },
      { opacity: 0, zoom: 0, zIndex: -10 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
  });
  setTimeout(() => {
    form.classList.toggle("invisible");
  }, 400);
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
