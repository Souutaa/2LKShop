<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">TechShop</a>
            </li>

            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div>
        <h4 class="page-title">Products</h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-sm-4">
            <?php
              if (isLoggedIn() && in_array('P_Create', $user->getPermissions())):
            ?>
              <button type="button" class="btn btn-primary" id="add-product-btn" data-bs-toggle="modal"
                data-bs-target="#add-new-product">
                Add product
              </button>
            <?php endif ?>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
              <thead class="table-light">
                <tr>
                  <th class="all">Product</th>
                  <th>Category</th>
                  <th>Added Date</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th style="width: 85px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($productList->productList as $product): ?>
                  <tr>
                    <td>
                      <img src="/2LKShop/public/images/thumbNail/<?php echo $product->getThumbnail() ?>"
                        alt="<?php echo $product->getProductName() ?>" title="<?php echo $product->getProductName() ?>"
                        class="rounded me-3" height="48" />
                      <p class="m-0 d-inline-block align-middle font-16 text-wrap w-75">
                        <?php echo $product->getProductName() ?>
                      </p>
                    </td>
                    <td>
                      <?php echo $product->getCategoryName() ?>
                    </td>
                    <td>
                      <?php echo $product->getCreatedAt() ?>
                    </td>
                    <td>
                      <?php echo number_format($product->getPrice()) ?>đ
                    </td>

                    <td>
                      <?php if ($product->getStock() == null): ?>
                        0
                      <?php else: ?>
                        <?php echo ($product->getStock()) ?>
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($product->getDeletedAt() == null): ?>
                        <span class="badge bg-success">
                          Actived
                        </span>
                      <?php else: ?>
                        <span class="badge bg-danger">
                          Deactived
                        </span>
                      <?php endif ?>
                    </td>

                    <td class="table-action">
                      <button type="button" class="action-icon btn" data-bs-toggle="modal" data-bs-target="#see-product"
                        id="see-product-selected" data-product-id="<?php echo $product->getProductLine() ?>">
                        <i class="mdi mdi-eye"></i>
                      </button>
                      <?php if ($product->getDeletedAt() == null): ?>
                        <?php
                          if (isLoggedIn() && in_array('P_Edit', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn" data-bs-toggle="modal"
                            data-bs-target="#change-product" 
                            data-product-id="<?php echo $product->getProductLine() ?>">
                            <i class="mdi mdi-square-edit-outline"></i>
                          </button>
                        <?php endif ?>
                        <?php
                          if (isLoggedIn() && in_array('P_AddQty', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn" data-bs-toggle="modal"
                            data-bs-target="#update-quantity-product" id="update-quantity-product-selected"
                            data-product-id="<?php echo $product->getProductLine() ?>">
                            <i class="mdi mdi-database-plus"></i>
                          </button>
                        <?php endif ?>
                        <?php
                          if (isLoggedIn() && in_array('P_Delete', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn delete-btn"
                            data-product-id="<?php echo $product->getProductLine() ?>">
                            <i class="mdi mdi-delete"></i>
                          </button>
                        <?php endif ?>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="add-new-product" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="fill-info-modalLabel">
          Add new product
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <form class="ps-3 pe-3" id="create-form" method="POST" action="" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="product-line" class="form-label">Line</label>
            <input class="form-control" type="text" name='product_line' id="product-line" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="product-name" class="form-label">Name</label>
            <input class="form-control" type="text" name='product_name' id="product-name" placeholder="" />
          </div>

          <div class="mb-3">
            <label class="form-label" for="product-thumbnail">Thumbnail</label>
            <input class="form-control" type="file" id="product-thumbnail" name='thumbnail' accept="image/*" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="product-img">Image</label>
            <input class="form-control" type="file" id="product-img" name='image[]' accept="image/*" multiple/>
          </div>
          
          <div class="row g-2 mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="product-price">Price</label>
              <input class="form-control" type="number" id="product-price" name='price' />
            </div>
            <div class="col-sm-6">
              <label for="product-discount" class="form-label">Discount</label>
              <input class="form-control" type="number" name='discount' id="product-discount" />
            </div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-sm-6">
              <label for="example-select" class="form-label">Warranty Period</label>
              <select class="form-select" name="warranty" id="example-select">
                <option value='null'>Không có bảo hành</option>
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
                  <option value=<?php echo $brand->id ?>><?php echo $brand->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="example-select" class="form-label">Category</label>
              <select class="form-select" name="category" id="example-select">
                <?php foreach ($categories->categories as $category): ?>
                  <option value=<?php echo $category->getCategoryID() ?>><?php echo $category->getCategoryName() ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="information" class="form-label">Information</label>
            <button id="add-info" class="btn btn-link btn-sm">
              More info
            </button>
            <div id="information-group">
              <input class="form-control" name="information[]" type="text" id="information" />
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="serial_number" class="form-label">Serial Number</label>
            <button id="add-sn" class="btn btn-link btn-sm">
              More S/N
            </button>
            <div id="serial_number-group">
              <input class="form-control" name="serial_number[]" type="text" id="serial_number" />
            </div>
          </div>
          <div class="mb-3 modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
              Close
            </button>
            <button class="btn btn-primary" type="submit" id="submit">
              Add new product
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="change-product" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="editModal">
    </div>
  </div>
</div>

<div id="see-product" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detailModal">
    </div>
  </div>
</div>

<div id="update-quantity-product" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="add-qty-modal">
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    <?php
    if (isLoggedIn() && in_array('P_Delete', $user->getPermissions())):
      ?>
      $('.delete-btn').click(function (e) {
        let id = $(this).attr('data-product-id');
        Swal.fire({
          title: 'Do you want to delete this product?',
          showCancelButton: true,
          confirmButtonText: 'Delete',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'POST',
              url: "<?php echo getPath($routes, 'deleteProduct') ?>".replace('{id}', id),
              success: (function (res) {
                Swal.fire({
                  title: 'Success!',
                  text: 'Product successfully deleted!',
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

    $('#add-product-btn').click(function (e) {
      console.log('clicked')
    })
  })
</script>
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
        formData.append('userID', "<?php echo $user->getUsername()?>")
        $.ajax({
          type: "POST",
          url: "<?php echo getPath($routes, 'createProduct') ?>",
          data: formData,
          success: function (res) {
            Swal.fire({
              title: 'Success!',
              text: 'Product successfully added!',
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
<script>

  $(document).ready(function () {
    $("#products-datatable").DataTable({
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>"
        },
        info: "Showing products _START_ to _END_ of _TOTAL_",
        lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> products'
      },
      pageLength: 5,
      columns: [
        {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !0
        }, {
          orderable: !1
        }],
      select: {
        style: "multi"
      },
      order: [[2, "desc"]],
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded"),
          $("#products-datatable_length label").addClass("form-label")
      }
    })
  });
</script>
<script>
  // Show Detail Modal
  $(document).ready(function () {
    $('#see-product').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var productId = button.data('product-id')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/product/detail/${productId}`,
        success: function (res) {
          $('#detailModal').html(res);
        }
      })
    })
  })

  // Show Edit Modal
  $(document).ready(function () {
    $('#change-product').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var productId = button.data('product-id')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/product/edit/${productId}`,
        success: function (res) {
          $('#editModal').html(res);
        }
      })
    })
  })

  // Show Add more product quantity
  $(document).ready(function () {
    $('#update-quantity-product').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var productId = button.data('product-id')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/product/addQty/${productId}`,
        success: function (res) {
          $('#add-qty-modal').html(res);
        }
      })
    })
  })


</script>