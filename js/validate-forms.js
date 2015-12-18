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
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng.'
        },
        comment: {
            required: 'Vui lòng điền ý kiến của bạn.',
            minlength: 'Ý kiến có ít nhất 5 ký tự.'
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
            required: 'Vui lòng nhập tên hoặc nickname.',
            minlength: 'Tên có ít nhất 2 ký tự.',
            maxlength: 'Tên phải ít hơn 40 ký tự.'
        },
        email: {
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng.',
            remote: 'Email này đã đăng ký.'
        },
        password: {
            required: 'Vui lòng nhập mật khẩu.',
            minlength: 'Mật khẩu có ít nhất 6 ký tự.'
        },
        confirm_password: {
            required: 'Vui lòng nhập xác nhận mật khẩu.',
            minlength: 'Xác nhận mật khẩu có ít nhất 6 ký tự.',
            equalTo: 'Xác nhận mật khẩu không đúng.'
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
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng.'
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
            required: 'Vui lòng nhập mật khẩu.',
            minlength: 'Mật khẩu có ít nhất 6 ký tự.'
        },
        confirmNewPassword: {
            required: 'Vui lòng nhập xác nhận mật khẩu.',
            minlength: 'Xác nhận mật khẩu có ít nhất 6 ký tự.',
            equalTo: 'Xác nhận mật khẩu không đúng.'
        }
    }
});//END Validate register-form

});//END ready method


