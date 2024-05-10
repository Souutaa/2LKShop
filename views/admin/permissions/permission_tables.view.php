<?php 
  $user = getSessionUser();
?>

<?php foreach ($permissions->permissions as $permissionGroup => $groupPermissions): ?>
  <?php foreach ($groupPermissions as $groupName => $groupPermission): ?>
    <div class="col-lg-4">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-centered mb-0" id="admin-permissions">
          <thead class="table-light">
            <tr>
              <th colspan="2">
                <?php echo $groupName ?>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($groupPermission) == 0): ?>
              <tr>
                <td>
                  Chưa có quyền nào thuộc nhóm quyền này!
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($groupPermission as $permission): ?>
                <?php if($permission->getDisabled() == 1) continue?>
                <tr>
                  <td>
                    <?php echo $permission->getPermissionName() ?>
                  </td>
                  <td style="width: 75px">
                    <?php
                      if (isLoggedIn() && in_array('Per_Edit', $user->getPermissions())):
                    ?>
                    <input type="checkbox" id="<?php echo $permission->getPermissionId()?>" <?php if (in_array($permission->getPermissionId(), $permissions->activePermission))
                      echo "checked" ?> data-switch="success" 
                      data-permission-id="<?php echo $permission->getPermissionId()?>"
                      />
                      <label for="<?php echo $permission->getPermissionId()?>" data-on-label="On" data-off-label="Off"></label>
                    <?php else: ?>
                      <?php if((in_array($permission->getPermissionId(), $permissions->activePermission))) echo '<span class="badge badge-success-lighten">Active</span>';
                            else echo '<span class="badge badge-danger-lighten">Deactive</span>'
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
  <?php endforeach ?>
<?php endforeach ?>

<script>

  $(document).ready(function() {
    $('input[type=checkbox]').change(function() {
      let isDisabled = $(this).is(':checked') ? 0 : 1;
      let permissionId = $(this).attr('data-permission-id')
      let userGroup = '<?php echo $role?>'
      console.log(userGroup, permissionId, isDisabled);
      let url = '/2LKShop/admin/addUserGroupPermission';
      if (isDisabled) {
        url = '/2LKShop/admin/removeUserGroupPermission';
      }
      $.ajax({
        type: 'POST',
        url: url,
        data: {
          'roleId': JSON.stringify(userGroup),
          'permissionId': JSON.stringify(permissionId)
        },
        success:function(res) {
          
        }
      })
    })
  })

</script>