<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Change Brand's information
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <form class="ps-3 pe-3" action="" method="post" id="edit-form">
    <div class="mb-3">
      <label for="brand-id" class="form-label">Brand Id</label>
      <input class="form-control" type="text" id="brand-id" required="" placeholder=""
        value="<?php echo $brand->getId() ?>" name='brandId' />
    </div>
    <div class="mb-3">
      <label for="brand-name" class="form-label">Brand Name</label>
      <input class="form-control" type="text" id="brand-name" required="" placeholder=""
        value="<?php echo $brand->getName() ?>" name='brandName' />
    </div>
    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Cancel
      </button>
      <button class="btn btn-primary" type="submit" id="save-change-btn" data-brand-id="<?php echo $brand->getId() ?>">
        Save change
      </button>
    </div>
  </form>
</div>

<script>
  $(document).ready(function (e) {
    $('#edit-form').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("ID", '<?php echo $brand->getId() ?>');
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'updateBrand') ?>",
        data: formData,

        contentType: false,
        processData: false,
        success: function (res) {
          console.log(res);
          Swal.fire({
            title: 'Success!',
            text: 'Brand successfully changed!',
            icon: 'success',
            confirmButtonTeNxt: 'Cool!'
          })
            .then(() => {
              location.reload();
            })
        }
      })
    })
  })
</script>