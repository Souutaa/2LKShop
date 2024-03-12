<section class="container div-8-col h-100vh">
  <div class="slide-sign-in__container">
    <div class="slide"></div>
    <div class="slide__arrow"></div>
    <div class="slide__panigation"></div>
  </div>
  <div class="form__container--right">
    <h3 class="heading__secondary u-margin-bottom-big">Đăng nhập</h3>
    <form action="" method="POST" class="form w-full text-color--1 font-size-2">
      <div class="form__field u-margin-bottom-medium">
        <label for="username" class="form__label u-margin-bottom-small">Tài khoản</label>
        <input id="username" name="username" placeholder="abc@gmail.com" class="form__input" />
      </div>
      <div class="form__field u-margin-bottom-medium">
        <label for="password" class="form__label u-margin-bottom-small">Mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="*******" class="form__input" />
      </div>
      <button type="submit" id="login-btn" class="btn btn__primary btn__primary--active u-center-text">
        Đăng nhập
      </button>
      <a href="./forgot-pass.html" class="para--sm text-color--2">Quên mật khẩu</a>
      <span class="line u-margin-bottom-medium"></span>
      <h4 class="heading__territory u-center-text">
        Bạn chưa có tài khoản?
      </h4>
      <a href="<?php echo $routes->get('register')->getPath(); ?>" class="btn btn__territory u-center-text">
        Đăng ký ngay
      </a>
    </form>
  </div>
</section>
<script>
  $('#login-btn').click((e) => {
    e.preventDefault();
    let searchString = "&username=" + $("#username").val() + "&password=" + $("#password").val();
    $.ajax({
      type: "POST",
      url: "<?php echo $routes->get('login')->getPath() ?>",
      data: searchString,
      success: function (res) {
        console.log(res)
        resData = JSON.parse(res)
        if (resData.status === 'fail') {
          new Notify({
            status: 'error',
            title: 'Lỗi',
            text: resData.message,
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 2000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
          })
        } else {
          window.location.replace(<?php echo $routes->get('homepage')->getPath() ?>);
        }
      }
    });
  })
</script>