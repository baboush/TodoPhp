/**
 * Logs out the user.
 *
 * This function sends a POST request to the server to log out the user.
 * It does not handle the response from the server.
 *
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
export const logout = async () => {
  await fetch("../../../Core/Usecase/User/Logout-usecase.php", {
    method: "POST",
  });
};
