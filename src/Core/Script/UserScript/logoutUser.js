export const logout = async () => {
  await fetch("../../../Core/Usecase/User/Logout-usecase.php", {
    method: "POST",
  });
};
