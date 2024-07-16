import { errorSnackbar, successSnackbar } from "../Utils/snackBar.js";

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
