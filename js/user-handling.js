$(document).ready(function(){

//Validate #user-info-form
$('#user-info-form').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        first_name: {
            required: true,
            minlength: 2,
            maxlength: 40
        },
        last_name: {
            minlength: 2,
            maxlength: 40
        },
        tel: {
            digits: true,
            minlength: 10,
            maxlength: 11
        }
    },
    messages: {
        first_name: {
            required: 'Oops! Vui lòng nhập tên hoặc nickname.',
            minlength: 'Oops! Tên phải nhiều hơn 2 ký tự.',
            maxlength: 'Oops! Tên phải ít hơn 40 ký tự.'
        },
        last_name: {
            minlength: 'Oops! Tên phải nhiều hơn 2 ký tự.',
            maxlength: 'Oops! Tên phải ít hơn 40 ký tự.'
        },
        tel: {
            digits: 'Oops! Vui lòng nhập số di động.',
            minlength: 'Oops! Vui lòng nhập số di động.',
            maxlength: 'Oops! Vui lòng nhập số di động.'
        }
    }
});//END Validate #user-info

$(document).ajaxStart(function() {
    $('.loading').show();
});

$(document).ajaxStop(function() {
    $('.loading').hide();
});

$('#user-button').click(function() {
    
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var tel = $('#tel').val();
    //var data = {fn:first_name, ln:last_name, phone:tel};

    $.ajax({
        type: 'get',
        url: 'processor/change-user-info.php',
        data: "fn="+first_name+"&ln="+last_name+"&phone="+tel,
        success: function(respone) {
            if(respone == true) {
                $('#alert').html("<div class='alert-success alert alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>    
            <span class='glyphicon glyphicon-ok'></span> Cập nhật thành công.</div>");
            } else {
                $('#alert').html("<div class='alert-danger alert alert-dismissible' role='alert'>   
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <span class='glyphicon glyphicon-exclamation-sign'></span> Đã có lỗi xảy ra.</div>");
            }
        }
    });

});

});