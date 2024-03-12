let products = [
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    imgPath: "./img/Image.png",
    price: "23.771.205",
  },
];

window.onload = () => {
  if (!localStorage.getItem("products")) {
    localStorage.setItem("products", JSON.stringify(products));
  }
};
renderCart();
function renderCart() {
  let products = JSON.parse(localStorage.getItem("products"));
  const renderCarts = document.getElementById("render-cart");
  let hmtl = ``;
  products.forEach((element) => {
    hmtl += `
    <div class="cart">
    <a href="./product-detail.html" class="cart__item">
      <img src="${element.imgPath}" alt="" class="cart__img" />
      <div class="cart__wrapper">
        <h3 class="cart__name font-size-1">
        ${element.name}
        </h3>
        <span class="cart__price font-color-1">Đ${element.price}</span>
        <button
          class="btn btn__primary btn__primary--active add-to-cart"
        >
          Thêm vào giỏ
        </button>
      </div>
      </a>
    </div>

    `;
  });
  renderCarts.innerHTML = hmtl;
}
