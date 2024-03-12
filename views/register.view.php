<?php
use App\Controllers\RegisterController;

$user = new RegisterController();
?>

<style>
  .invalid_Error {
    color: #d93b3e;
  }

  .border_Error {
    border: 1px solid #d93b3e;
  }

  .BorderInputBlue {
    border: 2px solid #4688f1;
  }

  .Input_Error:focus {
    border: 2px solid #d93b3e;
  }

  .Success:focus {
    border: 2px solid #4688f1;
  }

  .Container-FistAndLast {
    display: flex;
  }

  .Container-Password {
    display: flex;
  }
</style>

<div class="password container div-8-col">
  <div class="form__container--center">
    <h3 class="heading__secondary u-margin-bottom-big">Đăng ký</h3>
    <form id="form-Register" method="post" class="form w-full text-color--1 font-size-2">
      <div class="form__field-box">
        <div class="form__field u-margin-bottom-medium">
          <label for="fist-name" class="form__label u-margin-bottom-small">Họ </label>
          <input type="text" id="fist-name" name="fist-name" placeholder="Nguyễn Văn" class="form__input Success" />
          <span class="form-message"></span>
        </div>

        <div class="form__field u-margin-bottom-medium">
          <label for="Last-name" class="form__label u-margin-bottom-small">Tên</label>
          <input type="text" id="Last-name" name="Last-name" placeholder="A" class="form__input Success" />
          <span class="form-message"></span>
        </div>
      </div>
      <div class="form__field u-margin-bottom-medium">
        <label for="email" class="form__label u-margin-bottom-small">Email</label>
        <input type="email" id="email" name="email" placeholder="abc@gmail.com" class="form__input Success" />
        <span class="form-message"></span>
      </div>

      <div class="form__field u-margin-bottom-medium">
        <label for="Username" class="form__label u-margin-bottom-small">Tên đăng nhập</label>
        <input type="Username" id="Username" name="Username" placeholder="linhdao2468" class="form__input Success" />
        <span class="form-message"></span>
      </div>

      <div class="form__field-box">

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

      <button type="submit" class="btn btn__primary btn__primary--active u-center-text" name="Register">
        Đăng ký
      </button>
    </form>
  </div>
</div>
<!-- ============================================================js================================================================== -->
<!-- // BEGIN:Đối tượng 'Validator -->
<script src="/2LKShop/public/js/validator.js"></script>
<script>
<?php
    $name = $user -> getAccountInDB();//getAccountInDB
    $json_Value = json_encode($name);
    $Gmail = $user->getGmailInDB();
    $json_Value_Gmail = json_encode($Gmail);
    ?>
    
    let arr = [<?php echo $json_Value ?>]
    let accountArray = arr[0] 
    let gmailList = [<?php echo $json_Value_Gmail ?>]
    let gmailArray = gmailList[0]
    let fistName = document.querySelector('#fist-name');
    let lastName = document.querySelector('#Last-name');
    let Email = document.querySelector('#email');
    let userName = document.querySelector('#Username');
    let Password = document.querySelector('#password');
    // let re_Pass = document.querySelector('#re-password');
    Validator({
      form:"#form-Register",
      Account: accountArray,
      Gmail: gmailArray,
      fistName:fistName,
      lastName:lastName,
      Email:Email,
      userName:userName,
      Password:Password,
      // re_Pass:re_Pass,
      url:'<?php echo getPath($routes, 'register') ?>',
      rules: [
        Validator.isFist('#fist-name'),
        Validator.isLast('#Last-name', function (){
          return document.querySelector("#fist-name").value;
        }),
        Validator.isEmail('#email'),
        Validator.isUsername('#Username'),
        Validator.isPassword('#password'),
        Validator.isRe_Password('#re-password', function (){
          return document.querySelector('#form-Register #password').value;
        })
      ]
    });
    // console.log('<?php echo getPath($routes, 'createProduct') ?>');
</script>