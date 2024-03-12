<?php 
  $loggedInUser = getSessionUser();
?>

<?php foreach ($users->userList as $user): ?>
  <tr>
    <td class="table-user">
      <a href="javascript:void(0);" class="text-body fw-semibold">
        <?php echo $user->getUsername() ?>
      </a>
    </td>
    <td>
      <?php echo $user->getPhoneNumber() ?>
    </td>
    <td>
      <?php echo $user->getEmail() ?>
    </td>
    <td>
      <?php echo $user->getUserGroup() ?>
    </td>
    <td>
      <?php echo date('d-m-Y', strtotime($user->getCreatedAt())) ?>
    </td>
    <td>
      <?php if ($user->getDeletedAt() != null): ?>
        <span class="badge badge-danger-lighten">Deactive</span>
      <?php else: ?>
        <span class="badge badge-success-lighten">Active</span>
      <?php endif ?>
    </td>

    <td style="width: 100px">
      <?php
        if (in_array('U_Edit', $loggedInUser->getPermissions())):
      ?>
        <button type="button" class="action-icon btn" data-bs-toggle="modal" data-bs-target="#change-user-info"
          data-user-id="<?php echo $user->getUsername() ?>">
          <i class="mdi mdi-square-edit-outline"></i>
        </button>
      <?php endif ?>

      <?php
        if (isLoggedIn() && in_array('U_Delete', $loggedInUser->getPermissions())):
      ?>
        <?php if ($user->getDeletedAt() == null): ?>
          <button type="button" class="action-icon btn delete-btn" 
          data-user-id="<?php echo $user->getUsername() ?>">
            <i class="mdi mdi-delete"></i>
          </button>
        <?php endif ?>
      <?php endif ?>
    </td>
  </tr>
<?php endforeach ?>
