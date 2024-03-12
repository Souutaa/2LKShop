<?php
use App\Models\User;

if (!isLoggedIn()) {
  $_SESSION['isLoggedIn'] = false;
}
if (isLoggedIn()) {
  $user = new User();
  $user = unserialize($_SESSION['user']);
}
// if (!isLoggedIn() || !in_array('P_Edit', $user->getPermissions()))
//   redirect($routes->get('homepage')->getPath())
?>
<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Change product's information
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <form class="ps-3 pe-3" action="" id="edit-form">
    <div class="mb-3">
      <label for="product-line" class="form-label">Line</label>
      <input class="form-control" type="text" id="product-line" required="" placeholder=""
        value="<?php echo $product->getProductLine() ?>" name='product_line' disabled />
      <input class="form-control" type="text" id="product-line" required="" placeholder=""
        value="<?php echo $product->getProductLine() ?>" name='product_line' hidden />
    </div>
    <div class="mb-3">
      <label for="product-name" class="form-label">Name</label>
      <input class="form-control" type="text" id="product-name" required="" placeholder=""
        value="<?php echo $product->getProductName() ?>" name='product_name' />
    </div>
    <div class="mb-3">
      <label class="form-label">Thumbnail</label>
      <div class="d-flex flex-row gap-3 thumbnail-preview">
        <img src="/2LKShop/public/images/thumbNail/<?php echo $product->getThumbnail() ?>" alt="image"
          class="img-fluid rounded" width="200" />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="product-thumbnail">Select New Thumbnail</label>
      <input class="form-control mb-2 btn-add-thumbnail" type="file" name="newthumbnail" id="product-thumbnail"
        accept="image/*" />
    </div>
    <div class="row g-2 mb-3">
      <label class="form-label">Images</label>
      <div class="d-flex flex-row flex-wrap gap-3 old-img-preview-list">
        <?php foreach ($product->getImages() as $key => $image): ?>
          <div id="img-<?php echo $product->getProductLine() . $key ?>">
            <input class="form-control" type="text" id="product-name" value="<?php echo $image ?>" name='oldImage[]'
              hidden />
            <div style="position: relative; width: 100px" class="img-preview-item">
              <img src="<?php echo "/2LKShop/public/images/productImg/" . $product->getProductLine() . "/" . $image ?>"
                alt="image" class="img-fluid rounded" width="200" />
              <div class="position-absolute font-20 link-danger" style="top: 5px; right: 5px; cursor: pointer"
                id="delete-img">
                <i class="mdi mdi-delete delete-old-img-btn"
                  data-product-image="img-<?php echo $product->getProductLine() . $key ?>"></i>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label class="form-label" for="product-img">Add New Image</label>
        <input class="form-control mb-2 btn-add-img" type="file" id="product-img" name="newImage[]" accept="image/*"
          multiple />
      </div>
      <div class="d-flex flex-row flex-wrap gap-3 img-preview-list">
      </div>
    </div>

    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label class="form-label" for="product-price">Price</label>
        <input class="form-control" type="number" id="product-price" value="<?php echo $product->getPrice() ?>"
          name='price' />
      </div>
      <div class="col-sm-6">
        <label for="product-discount" class="form-label">Discount</label>
        <input class="form-control" type="number" id="product-discount" value="<?php echo $product->getDiscount() ?>"
          name='discount' />
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label for="example-select" class="form-label">Warranty Period</label>
        <select class="form-select" name="warranty" id="example-select">
          <option value='none'>Không có bảo hành</option>
          <?php foreach ($warrantyList->warrantyList as $warranty): ?>
            <option value=<?php echo $warranty->getWarrantyId() ?>><?php echo $warranty->getMonths() ?> Tháng</option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label for="example-select" class="form-label">Brand</label>
        <select class="form-select" name="brand" id="example-select">
          <?php foreach ($brands->brandList as $brand): ?>
            <option value="<?php echo $brand->id ?>" <?php if ($brand->id == $product->getBrandID())
                 echo "selected" ?>>
              <?php echo $brand->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-sm-6">
        <label for="example-select" class="form-label">Category</label>
        <select class="form-select" name="category" id="example-select">
          <?php foreach ($categories->categories as $category): ?>
            <option value="<?php echo $category->getCategoryID() ?>" <?php if ($category->getCategoryName() == $product->getCategoryName())
                 echo "selected" ?>><?php echo $category->getCategoryName() ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <label for="information" class="form-label">Information</label>
      <button id="add-more-info" class="btn btn-link btn-sm">
        More info
      </button>
      <div id="information-group-edit">
        <?php foreach ($product->getInfor() as $info): ?>
          <input class="form-control" name="information[]" type="text" id="information" value="<?php echo $info ?>" />
        <?php endforeach ?>
      </div>
    </div>
    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Cancel
      </button>
      <button class="btn btn-primary" type="submit" id="save-change-btn"
        data-product-id="<?php echo $product->getProductLine() ?>">
        Save change
      </button>
    </div>
  </form>
</div>

<!-- <script src="/2LKShop/public/js/handle_admin_product_img_preview.js"></script> -->
<script>
  btnAddThumbnail = document.querySelector(".btn-add-thumbnail");
  thumbnailPreview = document.querySelector(".thumbnail-preview");
  btnAddImage = document.querySelector(".btn-add-img");
  displayImgPreview = document.querySelector(".img-preview");
  slidePreviewList = document.querySelector(".img-preview-list");
  listImage = [];
  saveThumbnailPath = "";
  saveImgPath = "";


  function handleDeleteSlide(id) {
    listImage.splice(id, 1);
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
  function renderPreviewSlide(slideIndex) {
    let htmls = listImage.map(
      (item, index) => `
            <div
                style="position: relative; width: 100px"
                class="img-preview-item"
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
  $(document).ready(function (e) {
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
      for (let i = 0; i < e.target.files.length; i++) {
        const files = e.target.files[i];
        if (!files.type.match("image")) return;
        saveImgPath = URL.createObjectURL(files);
        listImage = [...listImage, { imgPath: saveImgPath }];
        let htmls = listImage.map(
          (item, index) => `
          <div
              style="position: relative; width: 100px; "
              class="img-preview-item"
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

    $('.delete-old-img-btn').click(function (e) {
      $(`#${$(this).attr('data-product-image')}`).remove();
    })

    $('#add-more-info').click((e) => {
      console.log('clicked')
      e.preventDefault();
      let newRow = `<input class="form-control" name='information[]' type='text' id="information">`
      $('#information-group-edit').append(newRow);
    })

    $('#edit-form').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'updateProduct') ?>",
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
          Swal.fire({
            title: 'Success!',
            text: 'Product updated!',
            icon: 'success',
            confirmButtonTeNxt: 'Cool!'
          }).then(() => {
            location.reload();
          })
        },

      })
    })

  })

</script>