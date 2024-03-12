<?php
  if (!isLoggedIn() || !in_array('P_Create', $user->getPermissions()))
    redirect($routes->get('homepage')->getPath())
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">
          Create Product
        </h1>
      </div>
    </div>
    <div class="row">
      <form id="create-form" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="product_line" class="form-label">Product Line</label>
          <input class="form-control" name='product_line' type='text' id="product_line">
        </div>
        <div class="form-group">
          <label for="product_name" class="form-label">Product Name</label>
          <input class="form-control" name='product_name' type='text' id="product_name">
        </div>
        <div class="form-group">
          <label for="information" class="form-label">Information</label>
          <button id='add-info'>More info</button>
          <div id="information-group">
            <input class="form-control" name='information[]' type='text' id="information">
          </div>
        </div>
        <div class="form-group">
          <label for="serial_number" class="form-label">Serial Number</label>
          <button id='add-sn'>More S/N</button>
          <div id="serial_number-group">
            <input class="form-control" name='serial_number[]' type='text' id="serial_number">
          </div>
        </div>
        <div class="form-group">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control" name='price' type='text' id="price">
        </div>
        <div class="form-group">
          <label for="image" class="form-label">Image</label>
          <input type="file" multiple class="form-control" name='image[]' id="image">
        </div>
        <div class="form-group">
          <label for="thumbnail" class="form-label">Thumbnail</label>
          <input type="file" class="form-control" name='thumbnail' id="thumbnail">
        </div>
        <div class="form-group">
          <label for="discount" class="form-label">Discount</label>
          <input type="text" class="form-control" name='discount' id="discount">
        </div>
        <div class="form-group">
          <label for="brand" class="form-label">Brand</label>
          <select id="brand" name="brand" class="form-select">
              <option>---Choose---</option>
            <?php foreach ($brands->brandList as $brand): ?>
              <option value=<?php echo $brand->id ?>><?php echo $brand->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="category" class="form-label">Category</label>
        <select id="category" name="category" class="form-select">
          <option>---Choose---</option>
          <?php foreach ($categories->categories as $category): ?>
            <option value=<?php echo $category->getCategoryID() ?>><?php echo $category->getCategoryName() ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" id="submit" value="Create New Product"></input>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(() => {
    $('#add-info').click((e) => {
      e.preventDefault();
      let newRow = `<input class="form-control" name='information[]' type='text' id="information">`
      $('#information-group').append(newRow);
    })
    $('#add-sn').click((e) => {
      e.preventDefault();
      let newRow = `<input class="form-control" name='serial_number[]' type='text' id="serial_number">`
      $('#serial_number-group').append(newRow);
    })
    $('#create-form').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append('userID', '<?php echo $user->getUsername() ?>');
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'createProduct') ?>",
        data: formData,
        success: function (res) {
          console.log(res)
        },
        contentType: false,
        processData: false
      })
    })
  })
</script>