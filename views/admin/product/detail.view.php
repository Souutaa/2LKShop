<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Product's Information
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <form class="ps-3 pe-3" action="#">
    <div class="mb-3">
      <label for="product-line" class="form-label">Line</label>
      <p class="form-control" type="text">
        <?php echo $product->getProductLine() ?>
      </p>
    </div>
    <div class="mb-3">
      <label for="product-name" class="form-label">Name</label>
      <p class="form-control" type="text">
        <?php echo $product->getProductName() ?>
      </p>
    </div>

    <div class="mb-3">
      <label class="form-label" for="see-product-thumbnail">Thumbnail</label>
      <div>
        <img src="<?php echo "/2LKShop/public/images/thumbNail/" . $product->getThumbNail() ?>" alt=""
          class="img-fluid rounded" id="see-product-thumbnail" width="200" />
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label" for="see-product-img">Images</label>
      <div>
        <?php foreach ($product->getImages() as $image): ?>
          <img src="<?php echo "/2LKShop/public/images/productImg/" . $product->getProductLine() . "/" . $image ?>"
            alt="" class="img-fluid rounded" width="200" />
        <?php endforeach; ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label class="form-label" for="product-price">Price</label>
        <input disabled class="form-control" type="text" id="product-price"
          value="<?php echo number_format($product->getPrice()) ?>" />
      </div>
      <div class="col-sm-6">
        <label for="product-discount" class="form-label">Discount(%):</label>
        <input disabled class="form-control" type="number" id="product-discount"
          value="<?php echo $product->getDiscount() ?>" />
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label for="example-select" class="form-label">Warranty Period</label>
        <input disabled class="form-control" type="text" id="example-select"
          value="<?php echo $product->getWarrantyId() ?? "Không có bảo hành" ?>" />
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label for="brand-select" class="form-label">Brand</label>
        <input disabled class="form-control" type="text" id="brand-select"
          value="<?php echo $product->getBrandID() ?>" />
      </div>
      <div class="col-sm-6">
        <label for="category-select" class="form-label">Category</label>

        <input disabled class="form-control" type="text" id="category-select"
          value="<?php echo $product->getCategoryName() ?>" />
      </div>
    </div>
    <div class="mb-3">
      <label for="information" class="form-label">Information</label>
      <div id="information-group">
        <?php foreach ($product->getInfor() as $info): ?>
          <p class="form-control" type="text">
            <?php echo $info ?>
          </p>
        <?php endforeach ?>
      </div>
    </div>
    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Close
      </button>
    </div>
  </form>
</div>