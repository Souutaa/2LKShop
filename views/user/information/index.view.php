<?php

use App\Models\User;

if (!isLoggedIn()) {
  $_SESSION['isLoggedIn'] = false;
}
if (isLoggedIn()) {
  $user = new User();
  $user = unserialize($_SESSION['user']);
}
?>
<style>
  .Display {
    display: inline-block !important;
  }

  .btn {
    display: none;
  }

  .None {
    display: none !important;
  }

  .font-error {
    color: red;
  }

  .DisplayImg {
    display: inline-block !important;
  }

  .btn {
    display: none;
  }

  .None {
    display: none !important;
  }

  .font-error {
    color: red;
  }
</style>


<div class="user__container">
  <div class="user__heading">
    <h3 class="heading__secondary">Hồ sơ của tôi</h3>
    <p class="font-size-1 text-color--4">
      Quản lý thông tin hồ sơ để bảo mật tài khoản
    </p>
  </div>
  <div class="user__information-form">
    <form action="" id="userImage" enctype="multipart/form-data">
      <div class="form__field-box u-margin-bottom-medium">
        <div class="form__field">
          <label for="user__avatar" class="form__label u-margin-bottom-small">Avatar Update</label>
          <input type="file" id="user__avatar" name='user__avatar' class="form-control" accept="image/*" />
        </div>
        <div class="form__field">
          <label for="user__first-name" class="form__label u-margin-bottom-small">Nhấn nút để thay đổi</label>
          <button type="submit" id="btnThayDoiImg" class=" btn DisplayImg btn__primary btn__primary--active u-center-text">
            Thay đổi
          </button>
        </div>
      </div>
    </form>
    <form action="" id="userInfo">
      <div class="form__field-box u-margin-bottom-medium">
        <div class="form__field">
          <label for="user__first-name" class="form__label u-margin-bottom-small">Họ và tên đệm</label>
          <input type="text" id="user__first-name" name="user__first-name" value="<?php echo ($user->getCurrentfirstNameInDB($user->getUsername()))[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
        <div class="form__field">
          <label for="user__last-name" class="form__label u-margin-bottom-small">Tên</label>
          <input type="text" id="user__last-name" name="user__last-name" value="<?php echo $user->getCurrentLastNameInDB($user->getUsername())[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
      </div>
      <div class="form__field-box">
        <div class="form__field u-margin-bottom-medium">
          <label for="user__email" class="form__label u-margin-bottom-small">Email</label>
          <input type="email" id="user__email" name="user__email" value="<?php echo $user->getCurrentEmailInDB($user->getUsername())[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
        <div class="form__field u-margin-bottom-medium">
          <label for="user__tel" class="form__label u-margin-bottom-small">Điện thoại</label>
          <input type="tel" id="user__tel" name="user__tel" value="<?php echo $user->getCurrentTelInDB($user->getUsername())[0] ?>" class="form__input form-js" />
          <span class="error font-error"></span>
        </div>
      </div>
      <div class="form__field-box">
        <div class="form__field u-margin-bottom-medium" id="province-select">
          <label for="order__address-city" class="form__label u-margin-bottom-small">Tỉnh, thành phố:</label>
          <select type="text" id="order__address-city" name="order__address-city" class="form__input form-js">
            <!-- Provinces -->
          </select>
        </div>
        <div class="form__field u-margin-bottom-medium">
          <label for="order__address-district" class="form__label u-margin-bottom-small">Quận, huyện:</label>
          <select type="text" id="order__address-district" name="order__address-district" class="form__input form-js">
            <!-- District -->
          </select>
        </div>
      </div>
      <div class="form__field u-margin-bottom-medium">
        <label for="password" class="form__label u-margin-bottom-small">Địa chỉ chi tiết:</label>
        <input type="text" id="order__address" name="order__address" value="<?php echo $user->getCurrentDetailedAddressInDB($user->getUsername())[0] ?>" placeholder="Số nhà, tên đường, xã, phường, thị trấn,..." class="form__input form-js" />
        <span class="error font-error"></span>
      </div>
      <button type="button" id="btnThayDoi" class=" btn Display btn__primary btn__primary--active u-center-text">
        Thay đổi
      </button>
      <button type="submit" id="btnSave" class=" btn  btn__success u-center-text">
        Lưu
      </button>
      <button type="button" id="btnHuy" class=" btn  btn__danger u-center-text">
        Hủy
      </button>
    </form>
  </div>
</div>
<script>
  $(document).ready(() => {
    $('#userImage').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      console.log(formData)
      formData.append('userID', "<?php echo $user->getUsername() ?>")
      $.ajax({
        type: "POST",
        url: "<?php echo getPath($routes, 'user') ?>",
        data: formData,
        success: function(res) {
          Swal.fire({
            title: 'Success!',
            text: 'Avatar123 successfully added!',
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

  async function getProvincesHanlder() {
    const provinceAPI = './public/json/provinces.json';
    console.log(provinceAPI);
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

    $("#order__address-city").on('change', function() {
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
          console.log(jsonData[i].districts[index].name);
          check = 1;
          break;
        }
      }
      if (check == 1) {
        $("#order__address-district").val(valueDistrict);
        // console.log(valueDistrict);
        break
      }

    }

  }

  $(document).ready(function(e) {
    getProvincesHanlder();
  })
</script>
<!-- xữ lý các nút btn -->
<script>
  let btnSave = document.querySelector('#btnSave');
  let btnHuy = document.querySelector('#btnHuy');
  let btnThayDoi = document.querySelector('#btnThayDoi');

  let btnSaveImg = document.querySelector('#btnSaveImg');
  let btnHuyImg = document.querySelector('#btnHuyImg');
  let btnThayDoiImg = document.querySelector('#btnThayDoiImg');

  let errorAll = document.querySelectorAll('.error');
  // let formInputAll = document.querySelectorAll('.form-js');
  $('.form-js').prop('disabled', true)
  // formInputAll.disabled = true;

  function SuaHoacHuy() {
    $('.form-js').prop('disabled', true)
    // errorAll.forEach((error) => {
    //   error.classList.add('None');
    // });
    btnHuy.classList.remove('Display');
    btnSave.classList.remove('Display');
    btnThayDoi.classList.add('Display')

    btnHuyImg.classList.remove('DisplayImg');
    btnSaveImg.classList.remove('DisplayImg');
    btnThayDoiImg.classList.add('DisplayImg')

  }

  function xuLyNutThayDoi() {
    $('.form-js').prop('disabled', false)
    // errorAll.forEach((error) => {
    //   error.classList.remove('None');
    // });
    btnHuy.classList.add('Display');
    btnSave.classList.add('Display');
    btnThayDoi.classList.remove('Display')

    btnHuyImg.classList.add('DisplayImg');
    btnSaveImg.classList.add('DisplayImg');
    btnThayDoiImg.classList.remove('DisplayImg')

  }
  let value_FirstName = document.querySelector('#user__first-name');
  let value_LastName = document.querySelector('#user__last-name');
  let value_Email = document.querySelector('#user__email');
  let value_tel = document.querySelector('#user__tel');
  let value_addressCity = document.querySelector('#order__address-city');
  let value_addressDistrict = document.querySelector('#order__address-district');
  let value_address = document.querySelector('#order__address');

  function xuLyNutHuy() {
    let valueProvince = '<?php echo $user->getCurrentCityInDB($user->getUsername())[0] ?>';
    let valueDistrict = '<?php echo $user->getCurrentDistrictInDB($user->getUsername())[0] ?>';
    $('#user__first-name').val('<?php echo ($user->getCurrentfirstNameInDB($user->getUsername()))[0] ?>');
    $('#user__last-name').val('<?php echo ($user->getCurrentLastNameInDB($user->getUsername()))[0] ?>');
    $('#user__email').val('<?php echo ($user->getCurrentEmailInDB($user->getUsername()))[0] ?>');
    $('#order__address').val('<?php echo ($user->getCurrentDetailedAddressInDB($user->getUsername()))[0] ?>');
    // $('#order__address-district').val('<?php echo ($user->getCurrentDistrictInDB($user->getUsername()))[0] ?>');
    // $('#order__address-city').val('<?php echo ($user->getCurrentCityInDB($user->getUsername()))[0] ?>');
    $('#user__tel').val('<?php echo ($user->getCurrentTelInDB($user->getUsername()))[0] ?>');
    // console.log($('#user__first-name').val());

    async function getProvincesHanlder() {
      const provinceAPI = './public/json/provinces.json';
      const res = await fetch(provinceAPI);
      const jsonData = await res.json();
      //const jsonData = ECHO jsonProvine.json();
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
          // console.log(valueDistrict);
          break
        }

      }
    }

    $(document).ready(function(e) {
      getProvincesHanlder();
    })
    $('.error').innerText = ""
    SuaHoacHuy()
    let mess_error = document.querySelectorAll('.error');
    if (value_FirstName.value == "<?php echo ($user->getCurrentfirstNameInDB($user->getUsername()))[0] ?>") {
      mess_error[0].innerText = ''
    }
    if (value_LastName.value == "<?php echo ($user->getCurrentLastNameInDB($user->getUsername()))[0] ?>") {
      mess_error[1].innerText = ''
    }
    if (value_Email.value == "<?php echo ($user->getCurrentEmailInDB($user->getUsername()))[0] ?>") {
      mess_error[2].innerText = ''
    }
    if (value_tel.value == "<?php echo ($user->getCurrentTelInDB($user->getUsername()))[0] ?>") {
      mess_error[3].innerText = ''
    }
    if (value_address.value == "<?php echo ($user->getCurrentDetailedAddressInDB($user->getUsername()))[0] ?>") {
      mess_error[4].innerText = ''
    }
  }












  // <!--=========================================================BEGIN: validate form user information===============================================-->
  function Validator(options) {
    // hàm thực hiện validate cho form
    function validate(inputElement, rule) {
      let errorElement = inputElement.parentElement.querySelector(".error")
      let errorMessage = rule.test(inputElement.value);
      if (errorMessage) {
        errorElement.innerText = errorMessage;
        console.log(inputElement.value);
      } else {
        errorElement.innerText = ''
        console.log(inputElement.value);
      }
      return !errorMessage; // trả về true(undefined) khi khong có lỗi và ngược lại

    }

    let formRegister = document.querySelector(options.form);
    if (formRegister) {
      // khi submit form
      formRegister.onsubmit = function(e) {
        e.preventDefault();
        let isFormValid = true
        options.rules.forEach(function(rule) {
          let inputElement = formRegister.querySelector(rule.selector)
          let isValid = validate(inputElement, rule);
          if (isValid == false) { //valid có lỗi
            isFormValid = false;
          }
        });
        console.log(isFormValid);

        // không còn lỗi validation thì đăng ký thành công
        //====================================== Xử lý dữ liệu khi không còn lỗi====================================================== 
        if (isFormValid == true) {
          let ObjectValueAll = {
            'user__firstName': value_FirstName.value,
            'user__lastName': value_LastName.value,
            'user__email': value_Email.value,
            'user__tel': value_tel.value,
            'order__addressCity': value_addressCity.value,
            'order__addressDistrict': value_addressDistrict.value,
            'order__address': value_address.value,
          }
          $.ajax({
            method: "POST",
            url: "<?php echo getPath($routes, "viewPersonalInfo") ?>",
            data: {
              jsonData: JSON.stringify(ObjectValueAll)
            },
            success: function(data) {
              Swal.fire(
                'SUCCESS!',
                'You have successfully updated your information!',
                'success'
              )
              // console.log(data);
            }

          });
          SuaHoacHuy()
        }
        //====================================== Xử lý dữ liệu khi không còn lỗi====================================================== 
      }
      options.rules.forEach(function(rule) {
        let inputElement = formRegister.querySelector(rule.selector)
        if (inputElement) {
          //xử lý trường hợp blue khỏi input
          inputElement.onblur = function() {
            validate(inputElement, rule);
          }

          // xử lý mỗi khi người dùng gõ vào input
          inputElement.oninput = function() {
            let errorElement = inputElement.parentElement.querySelector(".error")
            errorElement.innerText = ''
          }
        }

      });
    }
  }

  // Định nghĩa rules
  Validator.isFist = function(selector) {
    return {
      selector: selector,
      test: function(value) {
        regex = /[!@#$%^&*()\-+={}\[\]|\\:;"\'<>,.?/]/;
        if (regex.test(value)) { //trim() loại bỏ khoảng trắng
          return "Không được chứa ký tự đặc biệt!";
        }
        return undefined
      }
    };
  }

  Validator.isLast = function(selector) {
    return {
      selector: selector,
      test: function(value) {
        regex = /[!@#$%^&*()\-+={}\[\]|\\:;"\'<>,.?/]/;
        if (regex.test(value)) { //trim() loại bỏ khoảng trắng
          return "không được chứa ký tự đặc biệt!";
        }
        return undefined
      }
    };
  }

  Validator.isEmail = function(selector) {
    return {
      selector: selector,
      test: function(value) {
        let regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if (value != "" && !regex.test(value)) {
          return "Email vừa nhập không đúng. Vui lòng nhập lại!"
        }
        return undefined
      }
    };
  }

  Validator.isTel = function(selector) {
    return {
      selector: selector,
      test: function(value) {
        regex = /^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/;
        if (!regex.test(value)) { //trim() loại bỏ khoảng trắng
          return "Số điện thoại không đúng!";
        }
        return undefined

      }
    };
  }
  Validator.isAddressDetail = function(selector) {
    return {
      selector: selector,
      test: function(value) {
        regex = /[!@#$%^&*()\-+={}\[\]|\\:;"\'<>,.?/]/;
        if (regex.test(value)) { //trim() loại bỏ khoảng trắng
          return "Không được chứa ký tự đặc biệt!";
        }
        return undefined
      }
    };
  }






  // <!--====================================================END: validate form user information====================================================-->

  // -================================================Gọi hàm Validator==========================================================
  Validator({
    form: "#userInfo",
    fistName: value_FirstName,
    lastName: value_LastName,
    Email: value_Email,
    Tel: value_tel,
    address: value_address,
    // re_Pass:re_Pass,
    rules: [
      Validator.isFist('#user__first-name'),
      Validator.isLast('#user__last-name'),
      Validator.isEmail('#user__email'),
      Validator.isTel('#user__tel'),
      Validator.isAddressDetail('#order__address'),
    ]
  });
  btnHuy.addEventListener('click', xuLyNutHuy)
  btnThayDoi.addEventListener('click', xuLyNutThayDoi);
</script>