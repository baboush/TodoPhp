import { errorSnackbar, successSnackbar } from "../Utils/snackBar.js";

const handleSubmit = (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  fetch("../../../Core/Usecase/User/Login-usecase.php", {
    method: "POST",
    body: formData,
  }).then((response) => {
    alert(response);
    response
      .json()
      .then((data) => {
        if (data.success) {
          const message = `${data.message}, vous allez être redirigé !`;
          successSnackbar(message);
          setTimeout(() => {
            window.location.href = "../../../index.php";
          }, 3500);
        } else {
          errorSnackbar(data.message);
        }
      })
      .catch((error) => {
        alert("test");
        errorSnackbar(error.message);
      });
  });
};

document
  .querySelector("#form-login-user")
  .addEventListener("submit", handleSubmit);
