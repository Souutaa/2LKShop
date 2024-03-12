function Validator(options){
    // hàm thực hiện validate cho form
    function validate(inputElement, rule) {
        let errorElement = inputElement.parentElement.querySelector(".form-message")
        let errorMessage = rule.test(inputElement.value, options);
        if (errorMessage) {
            errorElement.innerText = errorMessage;
            errorElement.classList.add('invalid_Error');
            inputElement.classList.add('Input_Error');
            inputElement.classList.add('border_Error');
            inputElement.classList.remove('Success')
            console.log("hello");
        }else {
            errorElement.innerText = ''
            errorElement.classList.remove('invalid_Error');
            inputElement.classList.remove('border_Error');
            inputElement.classList.remove('Input_Error');
            inputElement.classList.add('Success')
        }
        return !errorMessage;// trả về true(undefined) khi khong có lỗi và ngược lại

    }
    let formRegister = document.querySelector(options.form);
    if (formRegister) {
        // khi submit formAccount
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
            if (isFormValid == true) {
                let fistName = options.fistName;
                let lastName = options.lastName;
                let Email = options.Email;
                let userName = options.userName;
                let Password = options.Password;
                let re_Pass = options.re_pass;
                
              $.ajax({
                url: options.url,
                method: "POST",
                data: {fistName: fistName.value, lastName: lastName.value, Email: Email.value, userName: userName.value, Password: Password.value}, 
                success: function(data){
                    Swal.fire(
                        'SUCCESS!',
                        'You have successfully registered!',
                        'success'
                      )
                      $(options.form)[0].reset();
                    console.log(data);
                }
              })
            //   alert("first Name:"+options.fistnName.value)
            }
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
                    let errorElement = inputElement.parentElement.querySelector(".form-message")
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
            if (value.trim() == '') {//trim() loại bỏ khoảng trắng
                return "Xin vui lòng nhập họ"
            }
            return undefined
        }
    };
}

Validator.isLast = function (selector, ValueFistName) {
    return {
        selector: selector,
        test: function(value){
            if (value.trim() == '' && ValueFistName() !=='') {//trim() loại bỏ khoảng trắng
                return "Xin vui lòng nhập tên"
            }
            return undefined
        }
    };
}

Validator.isEmail = function (selector) {
    return {
        selector: selector,
        test: function(value,option){
            if (value.trim() == '') {//trim() loại bỏ khoảng trắng
                return "Xin vui lòng nhập email"
            }else {
                let regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                if (!regex.test(value)) {
                    return "Email vừa nhập không đúng. Vui lòng nhập lại!"
                }else{
                    for (let index = 0; index < option.Gmail.length; index++) {
                        if (option.Gmail[index].Email === value) {
                            return "Email này đã tồn tại. Vui lòng nhập email khác!"
                        }                    
                    }
                }

            return undefined
        }
    }
};
}

Validator.isUsername = function(selector){
    return {
        selector: selector,
        test: function(value,option){
            if (value.trim() == '') {//trim() loại bỏ khoảng trắng
                return "Xin vui lòng nhập tên đăng nhập"
            } 
            let usernameRegex = /^[a-zA-Z0-9]+$/
            if (!usernameRegex.test(value.trim())) {
                return "Tên đăng nhập không được chứa kí tự đặc biệt"
            }
            for (let index = 0; index < option.Account.length; index++) {
                if (option.Account[index].Username === value) {
                    return "Tài khoản của bạn đã tồn tại!!"
                }
            }
            return undefined
        }
    };
}

Validator.isPassword = function(selector){
    return {
        selector: selector,
        test: function(value){
            if (value.trim() == '') {//trim() loại bỏ khoảng trắng
                return "Xin vui lòng nhập mật khẩu"
            }else {
                let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!regex.test(value)) {
                    return "Tối thiểu 8 ký tự. Chứa ít nhất một ký tự viết hoa, một ký tự viết thường, ký tự đặc biệt và chỉ bao gồm các chữ cái và số." 
                }
                return undefined
            }              
        }
    };
}
Validator.isRe_Password = function(selector, valuePassword) {
    return {
        selector: selector,
        test: function (value) {
            if(valuePassword() !== '') 
                if (value === ''){
                    return "Hãy xác nhận mật khẩu của bạn"
                }else if(value !== valuePassword()) return "Các mật khẩu vừa nhập không khớp"
            return undefined
        }
    };
}