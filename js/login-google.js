// Google Sign-In: Get profile information

var googleUser = {};
var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
        client_id: '955244326668-d1p2ho17t8irfn5rtp0og785dqr83qf5.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        scope: 'profile',
        });
        attachSignin(document.getElementById('customBtn'));
    });
};

function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
            console.log(googleUser.getBasicProfile().getName());
            console.log(googleUser.getBasicProfile().getEmail());
            console.log(googleUser.getBasicProfile().getImageUrl());

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            // Get response from login-google.php
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if (xmlhttp.responseText == "transactions.php" || xmlhttp.responseText == "my-team.php"){
                        // If no errors in writing to DB new user, redirect to respective pages
                        window.location.href = xmlhttp.responseText;
                    } else {
                        // If there is error, show that error
                        document.getElementById("message-alert").innerHTML = xmlhttp.responseText;
                    }
                }
            }

            // Open and send profile info of user to login-google.php to write to DB and get the response
            xmlhttp.open("POST", "login-google.php", true);
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send(
                'gName='+googleUser.getBasicProfile().getName()
                +'&'+'gImage='+googleUser.getBasicProfile().getImageUrl()
                +'&'+'gEmail='+googleUser.getBasicProfile().getEmail()
                );

        }, function(error) {
            alert(JSON.stringify(error, undefined, 2));
        });
}
