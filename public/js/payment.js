let optionCity = document.getElementById("order__address-city");
let optionDistrict = document.getElementById("order__address-district");
let optionListCity = [
  "Chọn tỉnh, thành phố",
  "San Francisco",
  "Los Angeles",
  "New York",
  "Las Vegas",
  "Miami",
  "Houston",
  "Seattle",
];

optionListCity.forEach((option) => {
  const optionElement = document.createElement("option");
  optionElement.textContent = option;
  optionElement.classList.add("form__option");
  optionCity.appendChild(optionElement);
});
optionListCity.forEach((option) => {
  const optionElement = document.createElement("option");
  optionElement.textContent = option;
  optionElement.classList.add("form__option");

  optionDistrict.appendChild(optionElement);
});
