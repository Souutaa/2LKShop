<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item">
            <a href="javascript: void(0);">Techshop</a>
          </li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
      </div>
      <h4 class="page-title">Account</h4>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane show active" id="account-customers">
            <div class="row mb-2">
              <div class="col-sm-4">
                <?php
                  if (in_array('U_create', $user->getPermissions())):
                ?>
                  <button type="button" class="btn btn-primary" id="add-user-btn" data-bs-toggle="modal"
                    data-bs-target="#add-new-user">
                    Add User
                  </button>
                <?php endif ?>
              </div>

              <!-- end col-->
            </div>

            <div class="table-responsive">
              <table class="table table-centered table-striped dt-responsive nowrap w-100" id="accounts-datatable">
                <thead>
                  <tr>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Create Date</th>
                    <th>Status</th>
                    <th style="width: 100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php require('user_list.view.php') ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- end card-body-->
    </div>
    <!-- end card-->
  </div>
  <!-- end col -->
</div>

<div id="add-new-user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="fill-info-modalLabel">
          Add user
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <form id="form-Register" method="post" class="form w-full text-color--1 font-size-2">
          <div class="form__field-box">
            <div class="form__field u-margin-bottom-medium">
              <label for="fist-name" class="form__label u-margin-bottom-small">Họ </label>
              <input type="text" id="fist-name" name="fist-name" placeholder="Nguyễn Văn A"
                class="form__input Success" />
              <span class="form-message"></span>
            </div>

            <div class="form__field u-margin-bottom-medium">
              <label for="Last-name" class="form__label u-margin-bottom-small">Tên</label>
              <input type="text" id="Last-name" name="Last-name" placeholder="Nguyễn Văn A"
                class="form__input Success" />
              <span class="form-message"></span>
            </div>
          </div>
          <div class="form__field u-margin-bottom-medium mt-2">
            <label for="email" class="form__label u-margin-bottom-small">Email</label>
            <input type="email" id="email" name="email" placeholder="abc@gmail.com" class="form__input Success" />
            <span class="form-message"></span>
          </div>

          <div class="form__field u-margin-bottom-medium mt-2">
            <label for="Username" class="form__label u-margin-bottom-small">Tên đăng nhập</label>
            <input type="Username" id="Username" name="Username" placeholder="linhdao2468"
              class="form__input Success" />
            <span class="form-message"></span>
          </div>

          <div class="form__field-box mt-2">

            <div class="form__field u-margin-bottom-medium">
              <label for="password" class="form__label u-margin-bottom-small">Mật khẩu</label>
              <input type="password" id="password" name="password" placeholder="********" class="form__input Success" />
              <span class="form-message"></span>
            </div>

            <div class="form__field u-margin-bottom-medium">
              <label for="re-password" class="form__label u-margin-bottom-small">Xác nhận</label>
              <input type="password" id="re-password" name="re-password" placeholder="********"
                class="form__input Success" />
              <span class="form-message"></span>
            </div>

          </div>

          <div class="form__field-box mt-2">
            <div class="form__field u-margin-bottom-medium">
              <label for="example-select" class="form__label u-margin-bottom-small">Role</label>
              <select class="form-select" name="role-id" id="example-select">
                <?php foreach ($roles->roles as $role): ?>
                  <option value=<?php echo $role->getRoleId() ?>><?php echo $role->getRoleName() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn__primary btn__primary--active u-center-text mt-2" name="Register">
            Đăng ký
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="change-user-info" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editModal">
    </div>
  </div>
</div>
<script>

  $(document).ready(function () {

    const userList = <?php echo json_encode(serialize($users->userList))?>

    $('#form-Register').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);

      if (userList.includes(`"${$('#Username').val()}"`) || $('#Username').val().trim().length == 0 || !/^[a-zA-Z0-9]+$/.test($('#Username').val())) {
        Swal.fire({
          title: 'Error!',
          text: 'Username is not valid or already existed!',
          icon: 'error',
          confirmButtonTeNxt: 'Oops!'
        }).then(() => {
          return;
        })
      }

      if ($('#password').val().trim().length < 8 ) {
        Swal.fire({
          title: 'Error!',
          text: 'Passwords length length must have least 8 characters!',
          icon: 'error',
          confirmButtonTeNxt: 'Oops!'
        }).then(() => {
          return;
        })
      }

      if ($('#password').val() != $('#re-password').val()) {
        Swal.fire({
          title: 'Error!',
          text: 'Passwords is not matched!',
          icon: 'error',
          confirmButtonTeNxt: 'Oops!'
        }).then(() => {
          return;
        })
      }
      $.ajax({
        type: 'post',
        url: '/2LKShop/admin/createUser',
        data: formData,
        success: (function (res) {
         Swal.fire({  
           title: 'Success!',
           text: 'Account created successfully!',
           icon: 'success',
           confirmButtonTeNxt: 'Cool!'
          }).then(() => {
            location.reload();
          })
        }),
        contentType: false,
        processData: false,
      })
    })

    $(document).ready(function () {
      $('#change-user-info').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var username = button.data('user-id')
        $.ajax({
          type: 'get',
          url: `/2LKShop/admin/getEditUserForm`,
          data: {
            'username': JSON.stringify(username)
          },
          success: function (res) {
            $('#editModal').html(res);
          }
        })
      })
    })
  })
</script>
<script>
  <?php
  $user = getSessionUser();
  if (in_array('U_Delete', $user->getPermissions())):
    ?>
    $(document).ready(function () {
      $('.delete-btn').click(function () {
        let username = ($(this).attr('data-user-id'))
        Swal.fire({
          title: 'Do you want to disable this user?',
          showCancelButton: true,
          icon: 'question',
          confirmButtonText: 'Yes',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'POST',
              url: "/2LKShop/admin/deactiveUser",
              data: {
                'username': JSON.stringify(username)
              },
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
    })
  <?php else: ?>
    $(document).ready(function () {
      $('.delete-btn').click(function () {
        Swal.fire({
          title: 'Error!',
          text: 'You don\'t have the permission to delete product!',
          icon: 'error',
          confirmButtonText: 'OK'
        })
      })
    })
  <?php endif ?>
</script>

<script>
  $(document).ready(function () {
    $("#accounts-datatable").DataTable({
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>"
        },
        info: "Showing accounts _START_ to _END_ of _TOTAL_",
        lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> accounts'
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
      order: [[1, "asc"]],
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded"),
          $("#products-datatable_length label").addClass("form-label")
      }
    })
  });
</script>