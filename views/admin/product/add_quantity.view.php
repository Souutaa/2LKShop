<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Update Quantity Product
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <form class="ps-3 pe-3" action="" id="add-qty" method='post'>
    <div class="form-group mb-3">
      <input name="product_line" hidden value="<?php echo $productId ?>" />
      <label for="serial_number" class="form-label">Serial Number</label>
      <button id="add-more-sn" class="btn btn-link btn-sm" type='button'>
        More S/N
      </button>
      <div id="serial_number-group-qty">
        <input class="form-control" name="serial_number[]" type="text" id="serial_number" />
      </div>
    </div>

    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Close
      </button>
      <button class="btn btn-primary" type="submit" id="save-btn">
        Save change
      </button>
    </div>
  </form>
</div>
<script>

  $(document).ready(function () {
    $('#add-more-sn').click(function (e) {
      e.preventDefault();
      let newRow = `<input class="form-control" name="serial_number[]" type="text" id="serial_number">`
      $('#serial_number-group-qty').append(newRow);
    })

    $('#add-qty').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'saveQty') ?>",
        data: formData,
        success: function (res) {
          Swal.fire({
            title: 'Success!',
            text: `${$('#serial_number-group-qty').children().length} product added!`,
            icon: 'success',
            confirmButtonTeNxt: 'Cool!'
          }).then(() => {
            location.reload();
          })
        },
        contentType: false,
        processData: false
      })
    })
  })
</script>