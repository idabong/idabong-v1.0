$(document).ready(function(){
    $('#retrievePassword :button').click(function() {
        var newPassword = $('#newPassword').val();
        var newConfirmPassword = $('#newConfirmPassword').val();
        $('#ajaxLoader').removeClass('hidden');
            
            $.ajax({
                type: "get",
                url: "change-password.php",
                data: "newPassword="+newPassword+"&newConfirmPassword="+newConfirmPassword, 
                success: function(response) {
                    if(response == "YES") {
                        $('#available').html('<span class="avai">Email is available.</span>');
                    } else if (response == "NO") {
                        $('#available').html('<span class="not-avai">Email is NOT available.</span>');
                    }
                }
            });
        } else {
            $('#available').html('<span class="short">Email is too short.</span>');
        }
    });
});