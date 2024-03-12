let product__preview = [
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
  {
    name: "MacBook Air M1 Chip Lorem ipsum dolor sit, amet consectetur adipisicing elit.",
    price: "Đ23.771.205",
    imgPath: "./img/Image.png",
  },
];
window.onload = () => {
  if (!localStorage.getItem("product__preview")) {
    localStorage.setItem("product__preview", JSON.stringify(product__preview));
  }
  renderProduct();
  renderPreviewSlide(0);
};
function renderProduct() {
  const product__preview = JSON.parse(localStorage.getItem("product__preview"));
  product__preview.length = 8;
  $(function () {
    let container = $("#pagination" + `__${productType}`);
    container.pagination({
      dataSource: [...product__preview],
      pageSize: 4,
      callback: function (data, btn) {
        var dataHtml = '<div class="product-cards">';
        $.each(data, function (index, product) {
          dataHtml += `
          <div class="cart">
          <a href="./product-detail.html" class="cart__item">
            <img src="${product.imgPath}" alt="" class="cart__img" />
            <div class="cart__wrapper">
              <h3 class="cart__name font-size-1">
              ${product.name}
              </h3>
              <span class="cart__price font-color-1">Đ${product.price}</span>
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
        dataHtml += "</div>";
        $("#data-container" + `__${productType}`).html(dataHtml);
      },
    });
  });
}
