$( document ).ajaxStart(function() {
  $( ".loading" ).show();
});

$( document ).ajaxStop(function() {
  $( ".loading" ).hide();
});

$(document).ready(function(){

//Validate lastNameForm
$('#lastNameForm').validate({ 
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        last_name: {
            minlength: 2,
            maxlength: 40
        }
    },    
    messages: {
        last_name: {
            minlength: 'Họ phải có ít nhất 2 ký tự.',
            maxlength: 'Họ phải ít hơn 40 ký tự.'
        }
    }
});//END Validate lastNameForm

//Validate firstNameForm
$('#firstNameForm').validate({
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        first_name: {
            required: true,
            minlength: 2,
            maxlength: 40
        }
    },    
    messages: {
        first_name: {
            required: 'Tên không được bỏ trống.',
            minlength: 'Tên phải nhiều hơn 2 ký tự.',
            maxlength: 'Tên phải ít hơn 40 ký tự.'
        }
    }
});//END Validate firstNameForm

//Validate phoneForm
$('#phoneForm').validate({
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        tel: {
            digits: true,
            minlength: 10,
            maxlength: 11
        }
    },    
    messages: {
        tel: {
            digits: 'Vui lòng nhập số ĐTDĐ',
            minlength: 'Vui lòng nhập số ĐTDĐ',
            maxlength: 'Vui lòng nhập số ĐTDĐ'
        }
    }
});//END Validate phoneForm

//First name form handling
$('#firstNameSave').click(function() {
var first_name = $('#first_name').val();

$.ajax({
    type: 'GET',
    url: 'processor/change-first-name.php',
    data: "first_name="+first_name,
    success: function(response) {
        var response = response.trim(); 
        if(response == first_name) {
            $('#displayFn').html("Tên: <strong class='text-success'>"+response+"</strong>");
            $('.alert').addClass('hidden');
            $('.alert-success').removeClass('hidden');
        } else if(response == 'NO') {
            $('.alert').addClass('hidden');
            $('.alert-danger').removeClass('hidden');
        }
    }
});

});//End First name form handling

//Last name form handling
$('#lastNameSave').click(function() {
var last_name = $('#last_name').val();

$.ajax({
    type: 'GET',
    url: 'processor/change-last-name.php',
    data: "last_name="+last_name,
    success: function(response) {
        var response = response.trim(); 
        if(response == last_name) {
            $('#displayLn').html("Họ: <strong class='text-success'>"+response+"</strong>");
            $('.alert').addClass('hidden');
            $('.alert-success').removeClass('hidden');
        } else if(response == 'NO') {
            $('.alert').addClass('hidden');
            $('.alert-danger').removeClass('hidden');
        }
    }
});

});//End last name form handling

//Phone form handling
$('#phoneSave').click(function() {
   var phone = $('#tel').val();

   $.ajax({
        type: 'GET',
        url: 'processor/change-phone.php',
        data: "phone="+phone,
        success: function(response) {
            var response = response.trim(); 
            if(response == phone) {
                $('#displayPhone').html("Số ĐTDĐ: <strong class='text-success'>"+response+"</strong>");
                $('.alert').addClass('hidden');
                $('.alert-success').removeClass('hidden');
            } else if(response == 'NO') {
                $('.alert').addClass('hidden');
                $('.alert-danger').removeClass('hidden');
            }
        }
    });

});//End phone form handling

});

//Prevent enter from affecting .modal 
$('.modal').keypress(function(event){

    if (event.keyCode == 10 || event.keyCode == 13) 
        event.preventDefault();

});

//Change password handling
//Validate form
$('#changePassword').validate({
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        oldPassword: {
            minlength: 6,
            maxlength: 30
        },
        newPassword: {
            minlength: 6,
            maxlength: 30
        },
        confirmNewPassword: {
            minlength: 6, 
            equalTo: '#newPassword'
        }
    },
    messages: {
        oldPassword: {
            minlength: 'Mật khẩu tối thiểu có 6 ký tự.',
            maxlength: ' Mật khẩu tối đa có 30 ký tự.'
        },
        newPassword: {
            minlength: 'Mật khẩu tối thiểu có 6 ký tự.',
            maxlength: 'Mật khẩu tối đa có 30 ký tự.'
        },
        confirmNewPassword: {
            minlength: 'Mật khẩu tối thiểu có 6 ký tự.',
            equalTo: 'Xác nhận mật khẩu không đúng.'
        }
    }
});//END Validate register-form