$(document).ready(function() {


$( document ).ajaxStop(function() {
//hide loading after ajax finished
  $( ".loading" ).hide();
});


$('#facebookLogin').click(function() {
//show .loading after click
$( ".loading" ).show();

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);
  // The response object is returned with a status field that lets the
  // app know the current login status of the person.
  // Full docs on the response object can be found in the documentation
  // for FB.getLoginStatus().
  if (response.status === 'connected') {
    // Logged into your app and Facebook.
    FbLogin();
  } 
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
FB.init({
  appId      : '485151954989678',
  cookie     : true,  // enable cookies to allow the server to access 
                      // the session
  xfbml      : true,  // parse social plugins on this page
  version    : 'v2.2' // use version 2.2
});

// Now that we've initialized the JavaScript SDK, we call 
// FB.getLoginStatus().  This function gets the state of the
// person visiting this page and can return one of three states to
// the callback you provide.  They can be:
//
// 1. Logged into your app ('connected')
// 2. Logged into Facebook, but not your app ('not_authorized')
// 3. Not logged into Facebook and can't tell if they are logged into
//    your app or not.
//
// These three cases are handled in the callback function.

FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});

};

// Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Login
function FbLogin() {
  FB.login(function(response) {
    if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', {fields: 'id, email, first_name, last_name'}, function(response) {
       console.log('Good to see you, ' + response.first_name + '.');

        //*****Ajax call******//
        var fid = response.id;
        var email = response.email;
        var first_name = response.first_name;
        var last_name = response.last_name;
        var avatar = "https://graph.facebook.com/"+fid+"/picture";
        
        $.ajax({
            type: 'GET',
            url: 'processor/facebook-login.php',
            data: "first_name="+first_name+"&last_name="+last_name+"&email="+email+"&avatar="+avatar,
            success: function(ajaxResponse) {
                var ajaxResponse = ajaxResponse.trim(); 
                console.log(ajaxResponse);
                if(ajaxResponse == 'YES') {
                    //redirect to my-team page
                    window.location = "http://localhost/idabong-v1.0/team-profile.php";
                }
            }
        }); 
        
        //*****End Ajax call******//

     });//FB.api
    } else {
     console.log('User cancelled login or did not fully authorize.');
    }
  });
}

  
});//End click

});//End Ready



      