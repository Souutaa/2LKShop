<style>
  .font-error{
    color:red
  }
</style>
<div class="breadcrumb container">
  <a href="<?php echo getPath($routes, 'homepage') ?>" class="breadcrumb__link text-color--1">
    <svg class="icon">
      <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-home"></use>
    </svg>
    <span class="para--sm">Trang chủ</span>
  </a>
  <svg class="icon text-color--1">
    <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-chevron-right"></use>
  </svg>
  <a href="<?php echo getPath($routes, 'viewCart') ?>" class="breadcrumb__link">
    <span class="para--sm text-color--1">Giỏ hàng</span>
  </a>
  <svg class="icon text-color--2">
    <use xlink:href="/2LKShop/public/images/SVG/symbol-defs.svg#icon-chevron-right"></use>
  </svg>
  <a href="#" class="breadcrumb__link">
    <span class="para--sm text-color--2">Thanh toán</span>
  </a>
</div>

<div class="container mb-4">
  <h2 class="heading__secondary u-margin-bottom-medium">
    Thông tin thanh toán
  </h2>
  <div class="payment__container div-8-col">
    <div class="payment__form">
      <form action="" method="post" id="user-info-form" class="form">
        <div class="form__field-box">
          <div class="form__field u-margin-bottom-medium">
            <label for="firstName" class="form__label u-margin-bottom-small">Họ:</label>
            <input type="text" id="firstName" name="firstName" placeholder="Nguyễn Văn" class="form__input" />
            <span class="error-message font-error"></span>
          </div>
          <div class="form__field u-margin-bottom-medium">
            <label for="lastName" class="form__label u-margin-bottom-small">Tên:</label>
            <input type="text" id="lastName" name="lastName" placeholder="A" class="form__input" />
            <span class="error-message font-error"></span>
          </div>
        </div>
        <div class="form__field-box">
          <div class="form__field u-margin-bottom-medium">
            <label for="order__tel" class="form__label u-margin-bottom-small">Số điện thoại:</label>
            <input type="tel" id="order__tel" name="phoneNumber" placeholder="0xx xxx xxxx" class="form__input" />
            <span class="error-message font-error"></span>
          </div>
          <div class="form__field u-margin-bottom-medium">
            <label for="order__email" class="form__label u-margin-bottom-small">Email:</label>
            <input type="email" id="order__email" name="mail" placeholder="abc@gmail.com" class="form__input" />
            <span class="error-message font-error"></span>
          </div>
        </div>
        <div class="form__field-box">
          <div class="form__field u-margin-bottom-medium" id="province-select">
            <label for="order__address-city" class="form__label u-margin-bottom-small">Tỉnh, thành phố:</label>
            <select type="text" id="order__address-city" name="city" class="form__input">
              <!-- Provinces -->
            </select>
            <span class="error-message font-error"></span>
          </div>
          <div class="form__field u-margin-bottom-medium">
            <label for="order__address-district" class="form__label u-margin-bottom-small">Quận, huyện:</label>
            <select type="text" id="order__address-district" name="district" class="form__input">
              <!-- District -->
            </select>
          </div>
        </div>
        <div class="form__field u-margin-bottom-medium">
          <label for="password" class="form__label u-margin-bottom-small">Địa chỉ chi tiết:</label>
          <input type="text" id="order__address" name="detailedAddress"
          placeholder="Số nhà, tên đường, xã, phường, thị trấn,..." class="form__input" />
          <span class="error-message font-error"></span>
        </div>
        <div class="form__field u-margin-bottom-medium">
          <label for="order__note" class="form__label u-margin-bottom-small">Ghi chú:</label>
          <input type="text" id="order__note" name="note" placeholder="Ghi chú cho shipper" class="form__input" />
        </div>
        <div class="form__field u-margin-bottom-medium radio__group">
          <label for="payment__type" class="form__label u-margin-bottom-small">Hình thức nhận hàng:</label>
          <div class="radio__item">
            <input type="radio" id="payment__type--1" name="payment__type" />
            <label for="payment__type--1" class="radio__label">Nhận tại cửa hàng</label>
          </div>
          <div class="radio__item">
            <input type="radio" id="payment__type--2" name="payment__type" checked />
            <label for="payment__type--2" class="radio__label">Giao hàng tận nơi</label>
          </div>
        </div>
        <div class="payment__btn-group div-8-col">
          <a href="<?php echo getPath($routes, 'viewCart') ?>"
            class="btn btn__secondary btn--size-1 text-color--1 u-center-text">
            Sửa giỏ hàng
          </a>
          <button class="btn btn__primary btn__primary--active font-size-1 u-center-text" type="submit"
            id="payment__accept">
            Đặt hàng
          </button>
        </div>
      </form>
    </div>
    <div class="payment__info">
      <div class="payment__title div-8-col">
        <p class="text-color--1 font-size-1 item-col-1">Tên sản phẩm</p>
        <p class="text-color--1 font-size-1 item-col-2">Số lượng</p>
        <p class="text-color--1 font-size-1 item-col-3">Giá bán</p>
      </div>
      <div class="payment__list-item">
      </div>
      <hr class="hr" />
      <div class="shopping-cart__price-box u-margin-bottom-medium">
        <div class="shopping-cart__price">
          <span class="font-size-2 text-color--2 price-total">Tổng</span>
          <span class="font-size-4 text-color--2" id="price-total">0₫</span>
        </div>
        <div class="shopping-cart__price price-reduce">
          <span class="font-size-2 text-color--2">Giảm giá</span>
          <span class="font-size-4 color--red" id="price-reduce">0₫</span>
        </div>
        <div class="shopping-cart__price">
          <span class="font-size-1 text-color--1 price-last-total">Tổng cộng:</span>
          <span class="font-size-1 color--btn" id="price-last-total">0₫</span>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  async function getProvincesHanlder() {
    const res = await fetch('./public/json/provinces.json');
    console.log(res)
    const jsonData = await res.json();
    console.log(jsonData)

    for (let i = 0; i < jsonData.length; i++) {
      $("#order__address-city").append(`
        <option value="${jsonData[i].name}" data-province-id="${i}">${jsonData[i].name}</option>
      `)
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
  }

  
  $(document).ready(function (e) {
    let cart = {}
    if (localStorage.getItem('cart')) {
      cart = JSON.parse(localStorage.getItem('cart'))
    }
    if (Object.keys(cart).length <= 0) {
      window.location.replace('<?php echo getPath($routes, 'viewCart') ?>')
    }

    let cartTotal = JSON.parse(localStorage.getItem('cartTotal'))

    $('#price-total').text(formatPrice(cartTotal.total))
    $('#price-reduce').text(formatPrice(cartTotal.discount))
    $('#price-last-total').text(formatPrice(cartTotal.total - cartTotal.discount))

    getProvincesHanlder();

    


    let formPay = document.querySelector('user-info-form')  

    let value_FirstName = document.querySelector('#firstName');
    let value_LastName = document.querySelector('#lastName');
    let value_Email = document.querySelector('#order__email');
    let value_tel = document.querySelector('#order__tel');
    let value_addressCity = document.querySelector('#order__address-city');
    let value_addressDistrict = document.querySelector('#order__address-district');
    let value_address = document.querySelector('#order__address');


// <!--=========================================================BEGIN: validate form user information===============================================-->
$.ajax({
                method: 'get',
                data: {
                  cartItems: JSON.stringify(cart)
                },
                url: "<?php echo getPath($routes, 'getCartItems') ?>",
                success: (function (res) {
                  const productList = JSON.parse(res)
                  for (let index in productList) {
                    $('.payment__list-item').append(`
                      <div class="payment__item div-8-col">
                        <div class="payment__item-info item-col-1">
                          <h3 class="payment__item-name font-size-4 text-color--4">
                            ${productList[index].name}
                          </h3>
                        </div>
                        <div class="payment__quantity-box item-col-2">
                          <input type="number" min="1" max="9" step="1" value="${productList[index].quantity}" class="payment__item-quantity" disabled/>
                        </div>
                        <h3 class="payment__item-price font-size-4 text-color--4 item-col-3">
                          ${formatPrice(productList[index].price)}
                        </h3>
                      </div>
                    `)
                  }
                })
              })
function Validator(options){
    // hàm thực hiện validate cho form
    function validate(inputElement, rule) {
        let errorElement = inputElement.parentElement.querySelector(".error-message")
        let errorMessage = rule.test(inputElement.value,options);
        if (errorMessage) {
            errorElement.innerText = errorMessage;
            // console.log(inputElement.value);
        }else {
            errorElement.innerText = ''
            // console.log(inputElement.value);
        }
        return !errorMessage;// trả về true(undefined) khi khong có lỗi và ngược lại

    }

    let formRegister = document.querySelector(options.form);
    if (formRegister) {
        // khi submit form
        formRegister.onsubmit = function(e){
            e.preventDefault();
            let isFormValid = true
            options.rules.forEach(function (rule) {
                let inputElement = formRegister.querySelector(rule.selector)
                let isValid = validate(inputElement, rule);
                if (isValid == false) {//valid có lỗi
                    isFormValid = false;
                }
            });
            console.log(isFormValid);

            // không còn lỗi validation thì đăng ký thành công
//====================================== Xử lý dữ liệu khi không còn lỗi====================================================== 
            if (isFormValid == true) {
                  var formData = new FormData(this);
                  formData.append('userID', '<?php echo $user->getUsername() ?>');
                  formData.append('cartItems', JSON.stringify(cart));
                  formData.append('total', JSON.stringify(cartTotal.total - cartTotal.discount));
                  $.ajax({
                    type: "POST",
                    url: "<?php echo getPath($routes, 'createOrder') ?>",
                    data: formData,
                    success: function (res) {
                      console.log(res);
                      localStorage.removeItem('cart');
                      Swal.fire(
                        'Đặt hàng thành công!',
                        'Bạn có thể xem đơn đặt hàng của mình trong tài khoản!',
                        'success'
                      ).then((result) => {
                        if (result.isConfirmed) {
                          window.location = "<?php echo getPath($routes, 'viewOrders') ?>"
                        }
                      })
                    },
                    contentType: false,
                    processData: false
                  })
              }
//====================================== Xử lý dữ liệu khi không còn lỗi====================================================== 
        }
        options.rules.forEach(function (rule) {
            let inputElement = formRegister.querySelector(rule.selector)
            if (inputElement) {
                //xử lý trường hợp blue khỏi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }
                
                // xử lý mỗi khi người dùng gõ vào input
                inputElement.oninput = function () {
                    let errorElement = inputElement.parentElement.querySelector(".error-message")
                    errorElement.innerText = ''
                }
            }

        });
    }
}

// Định nghĩa rules
Validator.isFist = function (selector) {
    return {
        selector: selector,
        test: function(value){
          regex = /[!@#$%^&*()\-+={}\[\]|\\:;"\'<>,.?/]/;
          if (value == "") {
            return "Xin vui lòng nhập họ và tên đệm!"
          }else if (value !="" && regex.test(value)) {//trim() loại bỏ khoảng trắng
              return "Không được chứa ký tự đặc biệt!";
            }
            return undefined
        }
    };
}

Validator.isLast = function (selector) {
    return {
        selector: selector,
        test: function(value){
          regex = /[!@#$%^&*()\-+={}\[\]|\\:;"\'<>,.?/]/;
          if (value == "") {
            return "Xin vui lòng nhập tên!"
          }else if (value !=""&& regex.test(value)) {//trim() loại bỏ khoảng trắng
                return "không được chứa ký tự đặc biệt!";
            }
            return undefined
        }
    };
}

Validator.isEmail = function (selector) {
    return {
        selector: selector,
        test: function(value){
          regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
          if (value == "") {
            return "Không được để trống địa chỉ gmail!"
          }else if (value !=""&& value!="" && !regex.test(value)) {
              return "Email vừa nhập không đúng. Vui lòng nhập lại!"
          }
          return undefined
        }
    };
}

Validator.isTel = function(selector){
    return {
        selector: selector,
        test: function(value){
          
          regex = /^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/;
          if (value == "") {
            return "Số điện thoại không được để trống!"
          }else if (value !=""&& !regex.test(value)) {//trim() loại bỏ khoảng trắng
                return "Số điện thoại không đúng!";
            }
            return undefined
            
        }
    };
}
Validator.isAddressDetail = function(selector) {
    return {
        selector: selector,
        test: function (value) {
          regex = /[!@#$%^&*()\-+={}\[\]|\\:;"\'<>,.?/]/;
          if (value == "") {
            return "Không được để trống địa chỉ nhà!"
          }else if (value !=""&& regex.test(value)) {//trim() loại bỏ khoảng trắng
                return "Không được chứa ký tự đặc biệt!";
            }
            return undefined
        }
    };
}

Validator.isAddressCity = function(selector) {
    return {
        selector: selector,
        test: function (value, option) {
          if (option.addressDistrict.value == '') {
            // console.log(value);
                return "Xin vui lòng chọn tỉnh thành!";
            }
            return undefined
        }
    };
}






// <!--====================================================END: validate form user information====================================================-->

// -================================================Gọi hàm Validator==========================================================
Validator({
      form:"#user-info-form",
      fistName:value_FirstName,
      lastName:value_LastName,
      Email:value_Email,
      Tel: value_tel,
      address: value_address,
      addressCity:value_addressCity,
      addressDistrict: value_addressDistrict,
      // re_Pass:re_Pass,
      rules: [
        Validator.isFist('#firstName'),
        Validator.isLast('#lastName'),
        Validator.isEmail('#order__email'),
        Validator.isTel('#order__tel'),
        Validator.isAddressDetail('#order__address'),
        Validator.isAddressCity('#order__address-city'),
      ]
    });
  })

</script>