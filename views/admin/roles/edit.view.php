<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Change Role Information
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <form class="ps-3 pe-3" id="edit-form" method="POST" action="">
    <div class="row g-2 mb-3">
      <input class="form-control" type="text" name='role_id' value="<?php echo $role->getRoleId()?>" hidden/>
      <div class="col-sm-6">
        <label for="role-name" class="form-label">Name</label>
        <input class="form-control" type="text" name='role_name' value="<?php echo $role->getRoleName()?>" id="role-name" placeholder="" />
      </div>
    </div>
    <div class="mb-3">
      <label for="role-description" class="form-label">Description</label>
      <input class="form-control" type="text" value="<?php echo $role->getRoleDescription()?>" name='role_description' id="role-description"
        placeholder="" />
    </div>
    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Close
      </button>
      <button class="btn btn-primary" type="submit" id="submit">
        Save Change
      </button>
    </div>
  </form>
</div>

<script>

  $(document).ready(function() {
    $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'editRole') ?>",
        data: formData,
        success: function (res) {
          console.log(res)
          Swal.fire({
            title: 'Success!',
            text: 'Role info updated!',
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