<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    <?php echo $permissionGroupName ?> Permission Details
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="col-auto">
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-centered mb-0" id="admin-permissions">
      <tbody>
        <?php if (count($permissions->permissions) == 0): ?>
          <tr>
            <td>
              Chưa có quyền nào thuộc nhóm quyền này!
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($permissions->permissions as $permission): ?>
            <tr>
              <td>
                <?php echo $permission->getPermissionId() ?>
              </td>
              <td>
                <?php echo $permission->getPermissionName() ?>
              </td>
              <td style="width: 75px">
                <?php
                  if (isLoggedIn() && in_array('PerGr_TogglePer', $user->getPermissions())):
                ?>
                  <input type="checkbox" id="<?php echo $permission->getPermissionId() ?>" <?php if ($permission->getDisabled() == 0)
                      echo "checked" ?>
                      data-permission-id='<?php echo $permission->getPermissionId() ?>' data-switch="success" />
                  <label for="<?php echo $permission->getPermissionId() ?>" data-on-label="Yes" data-off-label="No"></label>
                <?php else: ?>
                  <?php if ($permission->getDisabled() == 0) echo '<span class="badge badge-success-lighten">Active</span>';
                        else echo '<span class="badge badge-success-lighten">Active</span>'
                  ?>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<script>

  $(document).ready(function () {
    $('input[type=checkbox]').change(function () {
      let isDisabled = $(this).is(':checked') ? 0 : 1;
      let permissionId = $(this).attr('data-permission-id')
      console.log(permissionId, isDisabled)
      $.ajax({
        type: 'post',
        url: `/2LKShop/admin/updatePermissionState`,
        data: {
          'permissionId': JSON.stringify(permissionId),
          'state': JSON.stringify(isDisabled)
        },
        success: function (res) {
        }
      })
    })
  })

</script>