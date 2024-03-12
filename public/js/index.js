const imgSlide = [
  {
    imgPath: "/2LKShop/public/images/banner/banner_2.png",
  },
  {
    imgPath: "/2LKShop/public/images/banner/banner_1.png",
  },
  {
    imgPath: "/2LKShop/public/images/banner/banner_1.png",
  },
  {
    imgPath: "/2LKShop/public/images/banner/banner_2.png",
  },
];

window.onload = () => {
  if (!localStorage.getItem("slide")) {
    localStorage.setItem("slide", JSON.stringify(imgSlide));
  }
  renderSlide(0);
};

function renderSlide(slideIndex) {
  let slides = JSON.parse(localStorage.getItem("slide"));
  const slide = document.querySelector(".slide");
  let html = `
    <a href="#" class="slide__link">
        <img src="${slides[slideIndex].imgPath}" alt="slide__img" class="slide__img" />
    </a>         
      `;
  slide.innerHTML = html;

  const navBtns = document.querySelector(".slide__panigation");
  htmls = slides.map(
    (slide, index) => `
          <label class="container" onclick='handleChangeSlide(${index})'>
              <input type="radio" name="radio" ${
                index === slideIndex && "checked"
              }>
              <span class="checkMark"></span>
          </label>
      `
  );
  navBtns.innerHTML = htmls.join("");

  const navArrows = document.querySelector(".slide__arrow");

  navArrows.innerHTML = `
    <svg class="arrow__item" onclick='handleChangeSlide(${
      slideIndex - 1 < 0 ? slides.length - 1 : slideIndex - 1
    })'>
        <use
            xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-chevron-left"
        ></use>
    </svg>
    <svg class="arrow__item" onclick='handleChangeSlide(${
      slideIndex + 1 > slides.length - 1 ? 0 : slideIndex + 1
    })'>
        <use
            xlink:href="/2LKShop/public/images/svg/symbol-defs.svg#icon-chevron-right"
        ></use>
    </svg>
      `;
}
function handleChangeSlide(slideIndex) {
  renderSlide(slideIndex);
}

function formatPrice(price) {
  var formatter = new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  });
  return formatter.format(price);
}
