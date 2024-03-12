<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a href="javascript: void(0);">Techshop</a>
              </li>

              <li class="breadcrumb-item active">Brand</li>
            </ol>
          </div>
          <h4 class="page-title">Brand</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-sm-4">
                <?php
                  if (isLoggedIn() && in_array('Br_Create', $user->getPermissions())):
                ?>
                  <button type="button" class="btn btn-primary" id="add-product-btn" data-bs-toggle="modal"
                    data-bs-target="#add-new-brand">
                    Add brand
                  </button>
                <?php endif ?>
              </div>

              <!-- end col-->
            </div>

            <div class="table-responsive">
              <table
                class="table table-centered w-100 table-hover dt-responsive nowrap"
                id="products-datatable"
              >
                <thead class="table-light">
                  <tr>
                    <th class="all" style="width: 150px">ID</th>
                    <th>Name brand</th>
                    <th style="width: 150px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($BrandList->brandList as $brand): ?>
                    <?php if ($brand->getDeleteAt() == null): ?>
                    <tr>
                      <td><?php echo $brand->getId() ?></td>
                      <td><?php echo $brand->getName() ?></td>
                      <td class="table-action">
                        <?php
                          if (isLoggedIn() && in_array('Br_Edit', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn" data-bs-toggle="modal"
                            data-bs-target="#change-brand" 
                            data-brand-id="<?php echo $brand->getId() ?>">
                            <i class="mdi mdi-square-edit-outline"></i>
                          </button>
                        <?php endif ?>
                        <?php
                          if (isLoggedIn() && in_array('Br_Delete', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn delete-btn"
                            data-brand-id="<?php echo $brand->getId() ?>">
                            <i class="mdi mdi-delete"></i>
                          </button>
                        <?php endif ?>
                      </td>
                    </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end card-body-->
        </div>
        <!-- end card-->
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>

  <div id="add-new-brand" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="fill-info-modalLabel">
          Add New Brand
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <form class="ps-3 pe-3" id="create-form" method="POST" action="" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="product-line" class="form-label">Line</label>
            <input class="form-control" type="text" name='brandId' id="product-line" placeholder="" required/>
          </div>
          <div class="mb-3">
            <label for="product-name" class="form-label">Name</label>
            <input class="form-control" type="text" name='brandName' id="product-name" placeholder="" required/>
          </div>          
          <div class="mb-3 modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
              Close
            </button>
            <button class="btn btn-success" type="submit" id="submit">
              Add new brand
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="change-brand" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editModal">
    </div>
  </div>
</div>


<script>
  $(document).ready(() => {
    const brandList = '<?php echo json_encode(serialize($BrandList))?>';
    $('#create-form').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);

      // console.log(brandList.includes(`"${$("#product-line").val().trim()}"`))

      if (brandList.includes(`"${$("#product-line").val().trim()}"`) || $("#product-line").val().trim().length == 0) {
        Swal.fire({
            title: 'Error!',
            text: 'Brand already existed or not valid!',
            icon: 'error',
            confirmButtonTeNxt: 'Oops!'
          })
          .then(() => {
            return;
          })
      } else {
        $.ajax({
          type: "POST",
          url: "<?php echo getPath($routes, 'createBrands') ?>",
          data: formData,
          success: function (res) {
            Swal.fire({
              title: 'Success!',
              text: 'Brand successfully added!',
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
      }
    })
  })
</script>
<script>
$(document).ready(function () {
    $('#change-brand').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var brandId = button.data('brand-id')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/brand/edit/${brandId}`,
        success: function (res) {
          $('#editModal').html(res);
        }
      })
    })
  })
</script>

<script>
  $(document).ready(function () {
    <?php
    if (isLoggedIn() && in_array('Br_Delete', $user->getPermissions())):
      ?>
      $('.delete-btn').click(function (e) {
        let id = $(this).attr('data-brand-id');
        Swal.fire({
          title: 'Do you want to delete this product?',
          showCancelButton: true,
          confirmButtonText: 'Delete',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'POST',
              url: "<?php echo getPath($routes, 'deleteBrand') ?>".replace('{id}', id),
              success: (function (res) {
                Swal.fire({
                  title: 'Success!',
                  text: 'Brand successfully deleted!',
                  icon: 'success',
                  confirmButtonTeNxt: 'Cool!'
                }).then(() => {
                  location.reload();
                })
              }),
            })
          }
        })

      })
    <?php else: ?>
      $('.delete-btn').click(function (e) {
        Swal.fire({
          title: 'Error!',
          text: 'You don\'t have the permission to delete product!',
          icon: 'error',
          confirmButtonText: 'OK'
        })
      })
    <?php endif; ?>
  })

  
</script>