let productItem = [
  {
    imgPath: "./img/banner_1.png",
  },
  {
    imgPath: "./img/banner_2.png",
  },
  {
    imgPath: "./img/banner_1.png",
  },
  {
    imgPath: "./img/Image.png",
  },
  {
    imgPath: "./img/Image.png",
  },
  {
    imgPath: "./img/Image.png",
  },
  {
    imgPath: "./img/Image.png",
  },
];
const slidePreviewList = document.querySelector(".product__img-slide");
window.onload = () => {
  if (!localStorage.getItem("productItem")) {
    localStorage.setItem("productItem", JSON.stringify(productItem));
  }
  renderSlide(0);
  renderPreviewSlide(0);
};

function renderSlide(slideIndex) {
  let productItem = JSON.parse(localStorage.getItem("productItem"));
  const slide = document.querySelector(".product__img-display");
  let html = `
              <img src="${productItem[slideIndex].imgPath}" alt="" class="slide__img">
      `;
  slide.innerHTML = html;
}

function renderPreviewSlide(slideIndex) {
  let productItem = JSON.parse(localStorage.getItem("productItem"));
  let htmls = productItem.map(
    (item, index) => `
    <li class="product__img-slide-item">
        <img src="${item.imgPath}" alt="" class="product__img-item ${
      slideIndex === index ? "product__img-item--active" : ""
    }" />
    </li>
      `
  );
  slidePreviewList.innerHTML = htmls.join("");

  const slideArrows = document.querySelector(".slide__arrow");

  slideArrows.innerHTML = `
          <svg class="arrow__item" onclick='handleChangeSlidePre(${
            slideIndex - 1 < 0 ? productItem.length - 1 : slideIndex - 1
          })'>
              <use xlink:href="img/symbol-defs.svg#icon-chevron-left"></use>
            </svg>

          <svg class="arrow__item" onclick='handleChangeSlideNext(${
            slideIndex + 1 > productItem.length - 1 ? 0 : slideIndex + 1
          })'>
          <use xlink:href="img/symbol-defs.svg#icon-chevron-right"></use>
        </svg>
      `;
}

let totalTrans = 0;
function handleChangeSlideNext(slideIndex) {
  let productItem = JSON.parse(localStorage.getItem("productItem"));
  renderSlide(slideIndex);
  renderPreviewSlide(slideIndex);
  if (slideIndex > productItem.length - 2) {
    totalTrans = 14 * (productItem.length - 2);
    slidePreviewList.style.transform = "translateX(" + -totalTrans + "rem)";
  } else if (slideIndex > 2 && slideIndex < productItem.length - 2) {
    totalTrans += 14;
    slidePreviewList.style.transform = "translateX(" + -totalTrans + "rem)";
  } else {
    totalTrans = 0;
    slidePreviewList.style.transform = "translateX(" + totalTrans + "rem)";
  }
  console.log(totalTrans);
}
function handleChangeSlidePre(slideIndex) {
  let productItem = JSON.parse(localStorage.getItem("productItem"));
  renderSlide(slideIndex);
  renderPreviewSlide(slideIndex);
  if (slideIndex > productItem.length - 2) {
    totalTrans = 14 * (productItem.length - 2);
    slidePreviewList.style.transform = "translateX(" + -totalTrans + "rem)";
  }
  if (slideIndex > 2 && slideIndex < productItem.length - 2) {
    totalTrans -= 14;
    slidePreviewList.style.transform = "translateX(" + -totalTrans + "rem)";
  } else {
    totalTrans = 0;
    slidePreviewList.style.transform = "translateX(" + totalTrans + "rem)";
  }
  console.log(totalTrans);
  console.log(slideIndex);
}
