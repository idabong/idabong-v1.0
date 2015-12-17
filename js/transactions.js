$( document ).ajaxStart(function() {
  $( ".loading" ).show();
});

$( document ).ajaxStop(function() {
  $( ".loading" ).hide();
});

$(document).ready(function() {

$('#date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#start_time, #end_time').datetimepicker({
    format: 'LT',
    locale: 'vi'
});


  //Validate Contact-form 
$('#post').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        teamName: {
            required: true,
            minlength: 2,
            maxlength: 60
        },
        contactName: {
            required: true,
            minlength: 2,
            maxlength: 60
        },
        tel: {
            digits: true,
            minlength: 10,
            maxlength: 11
        },
        groundName: {
            required: true,
            minlength: 2,
            maxlength: 60
        }
        
    },
    messages: {
         teamName: {
            required: 'Vui lòng nhập tên đội bóng',
            minlength: 'Tên có ít nhất 2 ký tự.',
            maxlength: 'Tên phải ít hơn 60 ký tự.'
        },
        contactName: {
            required: 'Vui lòng nhập tên hoặc nickname của bạn',
            minlength: 'Tên có ít nhất 2 ký tự.',
            maxlength: 'Tên phải ít hơn 60 ký tự.'
        },
        tel: {
            digits: 'Vui lòng nhập số ĐTDĐ',
            minlength: 'Vui lòng nhập số ĐTDĐ',
            maxlength: 'Vui lòng nhập số ĐTDĐ'
        },
        groundName: {
            required: 'Vui lòng nhập tên sân',
            minlength: 'Tên có ít nhất 2 ký tự.',
            maxlength: 'Tên phải ít hơn 60 ký tự.'
        }
    }
});//END Validate Contact-form
});