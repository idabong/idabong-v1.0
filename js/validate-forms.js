//Validate Forms
$(document).ready(function () {
//Validate Contact-form 
$('#contact-form').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        email: {
            required: true,
            email: true
        },
        comment: {
            required: true,
            minlength: 5
        }
    },
    messages: {
        email: {
            required: 'Oops! Vui lòng nhập email.',
            email: 'Oops! Email không đúng.'
        },
        comment: {
            required: 'Oops! Vui lòng điền ý kiến của bạn.',
            minlength: 'Oops! Ý kiến phải nhiều hơn 5 ký tự.'
        }
    },
});//END Validate Contact-form

//Validate register-form
$('#register-form').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        first_name: {
            required: true,
            minlength: 2,
            maxlength: 40
        },
        email: {
            required: true,
            email: true,
            remote: {   
                  url: "processor/check-email.php",
                  type: "post",
                  data:
                    {
                        email: function()
                        {
                            return $('#email').val();
                        }
                    } 
            }//END remote
        },
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            required: true,
            minlength: 6, 
            equalTo: '#password'
        }
    },
    messages: {
        first_name: {
            required: 'Oops! Vui lòng nhập tên hoặc nickname.',
            minlength: 'Oops! Tên phải nhiều hơn 2 ký tự.',
            maxlength: 'Oops! Tên phải ít hơn 40 ký tự.'
        },
        email: {
            required: 'Oops! Vui lòng nhập email.',
            email: 'Oops! Email không đúng.',
            remote: 'Oops! Email này đã đăng ký.'
        },
        password: {
            required: 'Oops! Vui lòng nhập mật khẩu.',
            minlength: 'Oops! Mật khẩu phải nhiều hơn 6 ký tự.'
        },
        confirm_password: {
            required: 'Oops! Vui lòng nhập xác nhận mật khẩu.',
            minlength: 'Oops! Xác nhận mật khẩu phải nhiều hơn 6 ký tự.',
            equalTo: 'Oops! Xác nhận mật khẩu không đúng.'
        }
    }
});//END Validate register-form

//Validate resend-activation-code form
$('#resendActivationCode, #forgotPassword').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        email: {
            required: 'Oops! Vui lòng nhập email.',
            email: 'Oops! Email không đúng.'
        }
    }
});//END Validate resend-activation-code form

//Validate retrieve password form
$('#retrievePassword').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        newPassword: {
            required: true,
            minlength: 6
        },
        confirmNewPassword: {
            required: true,
            minlength: 6, 
            equalTo: '#newPassword'
        }
    },
    messages: {
        newPassword: {
            required: 'Oops! Vui lòng nhập mật khẩu.',
            minlength: 'Oops! Mật khẩu phải nhiều hơn 6 ký tự.'
        },
        confirmNewPassword: {
            required: 'Oops! Vui lòng nhập xác nhận mật khẩu.',
            minlength: 'Oops! Xác nhận mật khẩu phải nhiều hơn 6 ký tự.',
            equalTo: 'Oops! Xác nhận mật khẩu không đúng.'
        }
    }
});//END Validate register-form

});//END ready method


