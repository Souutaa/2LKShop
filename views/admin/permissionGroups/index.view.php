<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">2LKSHOP</a>
            </li>

            <li class="breadcrumb-item active">Permission Groups</li>
          </ol>
        </div>
        <h4 class="page-title">Permission Groups</h4>
      </div>
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
            if (isLoggedIn() && in_array('PerGr_Create', $user->getPermissions())):
              ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-permission-group">
                  <i class="mdi mdi-file-plus"></i>
                  Add new permission group
                </button>
            <?php endif ?>
          </div>

          <!-- end col-->
        </div>

        <div class="table-responsive">
          <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
            <thead class="table-light">
              <tr>
                <th class="all" style="width: 100px">Group</th>
                <th>Description</th>
                <th style="width: 150px">Active</th>
                <th style="width: 150px">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($permissionGroups->groups as $permissionGroup): ?>
                  <tr>
                    <td>
                      <?php echo $permissionGroup->getName() ?>
                    </td>
                    <td>
                      <?php echo $permissionGroup->getDescription() ?>
                    </td>
                    <td>
                      <input type="checkbox" id="<?php echo $permissionGroup->getID() ?>" 
                        <?php echo ($permissionGroup->getDisabled() == 0 ? 'checked' : '') ?> 
                        data-permission-group="<?php echo $permissionGroup->getID() ?>"
                        data-switch="success" 
                      />
                      <label for="<?php echo $permissionGroup->getID() ?>" data-on-label="On" data-off-label="Off"></label>
                    </td>

                    <td class="table-action">
                      <button type="button" class="action-icon btn" data-bs-toggle="modal"
                        data-bs-target="#detail-permission" id="detail-permission-selected"
                        data-permission-group-id="<?php echo $permissionGroup->getID() ?>"
                        data-permission-group-name="<?php echo $permissionGroup->getName() ?>">
                        <i class="mdi mdi-eye"></i>
                      </button>
                      <?php
                      if (isLoggedIn() && in_array('PerGr_Edit', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn edit-btn" data-bs-toggle="modal"
                            data-bs-target="#edit-permission" data-permission-group-id="<?php echo $permissionGroup->getID() ?>"
                            data-permission-group-name="<?php echo $permissionGroup->getName() ?>"
                            >
                            <i class="mdi mdi-square-edit-outline"></i>
                          </button>
                      <?php endif ?>
                      <?php
                      if (isLoggedIn() && in_array('PerGr_AddPer', $user->getPermissions())):
                        ?>
                          <button type="button" class="action-icon btn add-btn" data-bs-toggle="modal"
                            data-bs-target="#add-permission" data-role-id="<?php echo $permissionGroup->getID() ?>">
                            <i class="mdi mdi-database-plus"></i>
                          </button>
                      <?php endif ?>
                    </td>
                  </tr>
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

<div id="add-permission" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="addPermissionModal">
    </div>
  </div>
</div>

<div id="edit-permission" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content " id="editModal">
    </div>
  </div>
</div>

<div id="detail-permission" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detailModal">
    </div>
  </div>
</div>


<div id="add-new-permission-group" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-info">
        <h4 class="modal-title" id="fill-info-modalLabel">
          Add Permission Group
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <form class="ps-3 pe-3" id="add-permission-group-form" method="POST" action="">
          <div class="mb-3">
            <label for="permission-group-name" class="form-label">Name</label>
            <input class="form-control" type="text" name='permission_group_name' id="permission-group-name" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="permission_group_description" class="form-label">Description</label>
            <input class="form-control" type="text" name='permission_group_desc' id="permission_group_description" placeholder="" />
          </div>
          <div class="mb-3 modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
              Close
            </button>
            <button class="btn btn-primary" type="submit" id="submit">
              Add group
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  $(document).ready(function() {
    $('#add-permission-group-form').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'createPermissionGroup') ?>",
        data: formData,
        success: function (res) {
          console.log(res)
          Swal.fire({
            title: 'Success!',
            text: 'Group successfully added!',
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

  $(document).ready(function () {
    $('input[type=checkbox]').change(function () {
      let isDisabled = $(this).is(':checked') ? 0 : 1;
      let permissionGroupId = $(this).attr('data-permission-group')
      console.log(permissionGroupId, isDisabled)
      $.ajax({
        type: 'post',
        url: `/2LKShop/admin/updatePermissionGroupState`,
        data: {
          'permissionGroupId': JSON.stringify(permissionGroupId),
          'state': JSON.stringify(isDisabled)
        },
        success: function (res) {
          console.log(res)
        }
      })
    })
  })

  // Show Detail Modal
  $(document).ready(function () {
    $('#detail-permission').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var permissionGroupId = button.data('permission-group-id')
      var permissionGroupName = button.data('permission-group-name')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/getPermissionDetail`,
        data: {
          'permissionGroupId': JSON.stringify(permissionGroupId),
          'permissionGroupName': JSON.stringify(permissionGroupName)
        },
        success: function (res) {
          $('#detailModal').html(res);
        }
      })
    })
  })

  // Show Edit Modal
  $(document).ready(function () {
    $('#edit-permission').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var permissionGroupId = button.data('permission-group-id')
      var permissionGroupName = button.data('permission-group-name')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/getEditPermissionGroupForm`,
        data: {
          'permissionGroupId': JSON.stringify(permissionGroupId),
          'permissionGroupName': JSON.stringify(permissionGroupName)
        },
        success: function (res) {
          $('#editModal').html(res);
        }
      })
    })
  })

  // Show Add permission to permission group
  $(document).ready(function () {
    $('#add-permission').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var roleId = button.data('role-id')
      $.ajax({
        type: 'get',
        url: `/2LKShop/admin/getPermissionForm`,
        data: {
          'permissionGroupId': JSON.stringify(roleId),
        },
        success: function (res) {
          $('#addPermissionModal').html(res);
        }
      })
    })
  })

</script>