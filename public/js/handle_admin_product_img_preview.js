// let btnAddThumbnail = document.querySelector(".btn-add-thumbnail");
// let thumbnailPreview = document.querySelector(".thumbnail-preview");
// let btnAddImage = document.querySelector(".btn-add-img");
// let displayImgPreview = document.querySelector(".img-preview");
// let slidePreviewList = document.querySelector(".img-preview-list");
let listImage = [];
let saveThumbnailPath = "";
let saveImgPath = "";

btnAddThumbnail.addEventListener("change", function (e) {
  const files = e.target.files[0];
  if (!files.type.match("image")) return;
  saveThumbnailPath = URL.createObjectURL(files);
  thumbnailPreview.innerHTML = `
      <img
        src="${saveThumbnailPath}"
        alt="image"
        class="img-fluid rounded"
        width="200"
      />
    `;
});
btnAddImage.addEventListener("change", function (e) {
  console.log(e.target.files.length)
  for (let i = 0; i < e.target.files.length; i++) {
    const files = e.target.files[i];
    if (!files.type.match("image")) return;
    saveImgPath = URL.createObjectURL(files);
    displayImgPreview.src = saveImgPath;
    displayImgPreview.classList.remove("d-none");
    listImage = [...listImage, { imgPath: saveImgPath }];
    let htmls = listImage.map(
      (item, index) => `
          <div
              style="position: relative; width: 100px; "
              class="img-preview-item" onclick="handleChangeSlide(${index})"
          >
              <img
              src="${item.imgPath}"
              alt="image"
              class="img-fluid rounded"
              width="200"
              />
              <div
              class="position-absolute font-20 link-danger"
              style="top: 5px; right: 5px; cursor: pointer"
              id="delete-img"
              >
              <i class="mdi mdi-delete" onclick='handleDeleteSlide(${index})'></i>
              </div>
          </div>
            `
    );
    slidePreviewList.innerHTML = htmls.join("");
  }
});

function renderSlide(slideIndex) {
  displayImgPreview.src = listImage[slideIndex].imgPath;
}

function renderPreviewSlide(slideIndex) {
  let htmls = listImage.map(
    (item, index) => `
            <div
                style="position: relative; width: 100px"
                class="img-preview-item" onclick="handleChangeSlide(${index})"
            >
                <img
                src="${item.imgPath}"
                alt="image"
                class="img-fluid rounded"
                width="200"
                />
                <div
                class="position-absolute font-20 link-danger"
                style="top: 5px; right: 5px; cursor: pointer"
                id="delete-img"
                >
                <i class="mdi mdi-delete" onclick='handleDeleteSlide(${index})'></i>
                </div>
            </div>
              `
  );
  slidePreviewList.innerHTML = htmls.join("");
}

function handleChangeSlide(slideIndex) {
  renderSlide(slideIndex);
  renderPreviewSlide(slideIndex);
}

function handleDeleteSlide(id) {
  if (listImage.length == 1) return;
  listImage.splice(id, 1);
  renderSlide(0);
  renderPreviewSlide(0);
  const dt = new DataTransfer()
  const input = btnAddImage
  const { files } = input
  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    if (id !== i)
      dt.items.add(file) // here you exclude the file. thus removing it.
  }
  input.files = dt.files // Assign the updates list
  console.log(btnAddImage.files)
}
