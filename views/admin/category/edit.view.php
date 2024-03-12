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
      Change Category's information
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
  </div>
  <div class="modal-body">
    <form class="ps-3 pe-3" action="" method="post" id="edit-form">
    <div class="mb-3">
      <label for="category-id" class="form-label">Category Id</label>
      <input class="form-control" type="text" id="category-id" required="" placeholder=""
        value="<?php echo $category->getCategoryID() ?>" name='categoryId' disabled/>
    </div>
    <div class="mb-3">
      <label for="category-name" class="form-label">Category Name</label>
      <input class="form-control" type="text" id="category-name" required="" placeholder=""
        value="<?php echo $category->getCategoryName() ?>" name='categoryName' />
    </div>
    <div class="mb-3 modal-footer">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">
        Cancel
      </button>
      <button class="btn btn-primary" type="submit" id="save-change-btn"
        data-category-id="<?php echo $category->getCategoryID() ?>">
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
            formData.append("ID",'<?php echo $category->getCategoryID() ?>');
            $.ajax({
                type: "POST",
                url: "<?php echo getPath($routes, 'updateCategory') ?>",
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