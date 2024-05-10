<div class="container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">2LKSHOP</a>
            </li>

            <li class="breadcrumb-item active">Permission</li>
          </ol>
        </div>
        <h4 class="page-title">Permission</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-sm-4">
              <div class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                <label for="status-select" class="me-2">Nhóm người dùng</label>
                <select class="form-select" id="role-select">
                  <option>---Chọn nhóm người dùng---</option>
                  <?php foreach ($roles->roles as $role): ?>
                    <?php if($role->getDisabled() == 0): ?>
                      <option data-role-id="<?php echo $role->getRoleId() ?>"><?php echo $role->getRoleName() ?></option>
                    <?php endif ?>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="permission-tables">
            
          </div>
        </div>
        <!-- end card-body-->
      </div>
      <!-- end card-->
    </div>
    <!-- end col -->
  </div>
</div>

<script>
  $(document).ready(function(e) {
    $('#role-select').change(function() {
      if($(this).find(':selected').attr('data-role-id')) {
        $.ajax({
          type: 'GET',
          url: '/2LKShop/admin/getRolePermission',
          data: {
            'role':JSON.stringify($(this).find(':selected').attr('data-role-id'))
          },
          success:function(res) {
            $('#permission-tables').html(res);
          }
        })
      } else {
        $('#permission-tables').html(``);
      }
    })
  })

</script>