<div class="modal-header modal-colored-header bg-info">
  <h4 class="modal-title" id="fill-info-modalLabel">
    Change
    <?php echo $user->getUsername() ?>'s information
  </h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
  <div class="user__information-form">
    <form action="" id="userInfo">
      <div class="form__field-box u-margin-bottom-medium">
        <div class="form__field">
          <label for="user__first-name" class="form__label u-margin-bottom-small">Họ và tên đệm</label>
          <input type="text" id="user__first-name" name="user__first-name"
            value="<?php echo ($user->getCurrentfirstNameInDB($user->getUsername()))[0] ?>"
            class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
        <div class="form__field">
          <label for="user__last-name" class="form__label u-margin-bottom-small">Tên</label>
          <input type="text" id="user__last-name" name="user__last-name"
            value="<?php echo $user->getCurrentLastNameInDB($user->getUsername())[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
      </div>
      <div class="form__field-box">
        <div class="form__field u-margin-bottom-medium">
          <label for="user__email" class="form__label u-margin-bottom-small">Email</label>
          <input type="email" id="user__email" name="user__email"
            value="<?php echo $user->getCurrentEmailInDB($user->getUsername())[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
        <div class="form__field u-margin-bottom-medium">
          <label for="user__tel" class="form__label u-margin-bottom-small">Điện thoại</label>
          <input type="tel" id="user__tel" name="user__tel"
            value="<?php echo $user->getCurrentTelInDB($user->getUsername())[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
      </div>
      <div class="form__field-box">
        <div class="form__field u-margin-bottom-medium" id="province-select">
          <label for="order__address-city" class="form__label u-margin-bottom-small">Tỉnh, thành phố:</label>
          <select type="text" id="order__address-city" name="order__address-city" class="form__input form-js">

          </select>
        </div>
        <div class="form__field u-margin-bottom-medium">
          <label for="order__address-district" class="form__label u-margin-bottom-small">Quận, huyện:</label>
          <select type="text" id="order__address-district" name="order__address-district" class="form__input form-js">

          </select>
        </div>
      </div>
      <div class="form__field u-margin-bottom-medium">
        <label for="password" class="form__label u-margin-bottom-small">Địa chỉ chi tiết:</label>
        <input type="text" id="order__address" name="order__address"
          value="<?php echo $user->getCurrentDetailedAddressInDB($user->getUsername())[0] ?>"
          placeholder="Số nhà, tên đường, xã, phường, thị trấn,..." class="form__input form-js" />
        <span class="error font-error"></span>
      </div>
      <div class="form__field-box mt-2">
        <div class="form__field u-margin-bottom-medium">
          <label for="example-select" class="form__label u-margin-bottom-small">Role</label>
          <select class="form-select" name="role-id" id="example-select">
            <?php foreach ($roles->roles as $role): ?>
              <option value=<?php echo $role->getRoleId() ?><?php if ($role->getRoleId() == $user->getUserGroup())
                                                                  echo "selected" ?>><?php echo $role->getRoleName() ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="mt-3 modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
          Cancel
        </button>
        <button class="btn btn-primary" type="submit" id="save-change-btn"
          data-user-id="<?php echo $user->getUsername() ?>">
          Save change
        </button>
      </div>
    </form>
  </div>
</div>

<script>

  $(document).ready(function () {
    $('#userInfo').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append('username', "<?php echo $user->getUsername() ?>")
      $.ajax({
        type: 'POST',
        url: '/2LKShop/admin/updateUserInfo',
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
          Swal.fire({
            title: 'Success!',
            text: 'Account info updated!',
            icon: 'success',
            confirmButtonTeNxt: 'Cool!'
          }).then(() => {
            location.reload();
          })
        }
      })
    })
  })

</script>

<script>
  async function getProvincesHanlder() {
    const provinceAPI = './public/json/provinces.json';
    const res = await fetch(provinceAPI);
    const jsonData = await res.json();
    let valueProvince = '<?php echo $user->getCurrentCityInDB($user->getUsername())[0] ?>';
    let valueDistrict = '<?php echo $user->getCurrentDistrictInDB($user->getUsername())[0] ?>';
    let check = 0;
    for (let i = 0; i < jsonData.length; i++) {
      $("#order__address-city").append(`
      <option value="${jsonData[i].name}" data-province-id="${i}">${jsonData[i].name}</option>
      `)
    }

    for (let i = 0; i < jsonData.length; i++) {
      if (valueProvince == jsonData[i].name) {
        $("#order__address-city").val(jsonData[i].name);
        $("#order__address-district").empty();
        const provinceId = $('#order__address-city').find(":selected").attr('data-province-id')
        for (let i = 0; i < jsonData[provinceId].districts.length; i++) {
          $("#order__address-district").append(`
        <option value="${jsonData[provinceId].districts[i].name}">${jsonData[provinceId].districts[i].name}</option>
        `)
        }
        break;
      }
    }

    $("#order__address-city").on('change', function () {
      $("#order__address-district").empty();
      const provinceId = $('#order__address-city').find(":selected").attr('data-province-id')
      for (let i = 0; i < jsonData[provinceId].districts.length; i++) {
        $("#order__address-district").append(`
        <option value="${jsonData[provinceId].districts[i].name}">${jsonData[provinceId].districts[i].name}</option>
        `)
      }

    });

    // quận hiện tại của tài khoản đó
    for (let i = 0; i < jsonData.length; i++) {
      for (let index = 0; index < jsonData[i].districts.length; index++) {
        if (jsonData[i].districts[index].name == valueDistrict) {
          check = 1;
          break;
        }
      }
      if (check == 1) {
        $("#order__address-district").val(valueDistrict);
        break
      }

    }

  }

  $(document).ready(function (e) {
    getProvincesHanlder();
  })
</script>