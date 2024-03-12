<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Edit <?php echo $permissionGroupName?>
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <form class="ps-3 pe-3" id="create-form" method="POST" action="">
    <div class="row g-2 mb-3">
      <div class="col-sm-6">
        <label for="permission-group-name" class="form-label">Name</label>
        <input class="form-control" type="text" name='permission_group_name' value="<?php echo $permissionGroup->getName()?>" id="permission-group-name" placeholder="" />
      </div>
    </div>
    <div class="mb-3">
      <label for="permission-group-description" class="form-label">Description</label>
      <input class="form-control" type="text" name='permission_group_description' value="<?php echo $permissionGroup->getDescription()?>" id="permission-group-description" placeholder="" />
    </div>
    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Close
      </button>
      <button class="btn btn-primary" type="submit" id="submit">
        Save change
      </button>
    </div>
  </form>
</div>
<script>
  $(document).ready(function () {
    $('#create-form').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append('permission_group_id', "<?php echo $permissionGroup->getID()?>")
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'updatePermissionGroup') ?>",
        data: formData,
        success: function (res) {
          Swal.fire({
            title: 'Success!',
            text: 'Group info updated!',
            icon: 'success',
            confirmButtonTeNxt: 'Cool!'
          })
          .then(() => {
            location.reload();
          })
        },
        contentType: false,
        processData: false
      })
    })
  })
</script>