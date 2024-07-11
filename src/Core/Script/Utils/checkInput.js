export const isValid = (elementInput, hint) => {
  hint.classList.add("invisible");
  elementInput.classList.remove("border-red-700");
  elementInput.classList.add("border-blue-700");
};

export const isNotValid = (elementInput, hint) => {
  elementInput.classList.remove("border-blue-700");
  elementInput.classList.add("border-red-700");
  hint.classList.remove("invisible");
};
