$(document).ready(function() {
//Validate Contact-form 
$('#teamForm').validate({ // initialize the plugin
    errorElement: 'span',
    errorClass: 'text-danger',
    rules: {
        teamName: {
            required: true,
            minlength: 2,
            maxlength: 60
        }
    },
    messages: {
       	teamName: {
            required: 'Vui lòng nhập tên.',
            minlength: 'Tên phải có ít nhất 2 ký tự.',
            minlength: 'Tên có nhiều nhất 60 ký tự.',
        }
    },
});//END Validate Contact-form

});
