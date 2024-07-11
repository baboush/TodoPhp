import { errorSnackbar, successSnackbar } from "../Utils/snackBar.js";

const handleSubmit = (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  fetch("../../../Core/Usecase/User/Delete-account-usecase.php", {
    method: "POST",
    body: formData,
  }).then((response) => {
    response
      .json()
      .then((data) => {
        if (data.success) {
          alert(data.id);
          const message = `${data.message}`;
          successSnackbar(message);
          setTimeout(() => {
            window.location.href = "../../../index.php";
          }, 3500);
        } else {
          errorSnackbar(data.message);
        }
      })
      .catch((error) => {
        errorSnackbar(error.message);
      });
  });
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
