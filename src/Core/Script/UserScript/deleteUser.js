import { errorSnackbar, successSnackbar } from "../Utils/snackBar.js";

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

const toggleFormDelete = () => {
  const form = document.querySelector("#form-delete-user");
  form.classList.toggle("invisible");
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
