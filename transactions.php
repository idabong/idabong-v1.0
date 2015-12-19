<?php
$title = 'Cáp kèo đá bóng'; include 'includes/header.php';
//Fetch team data
if(isset($_SESSION['uid'])) {
	$team = fetch_team($_SESSION['uid']);
}
?>
	<div id="content">
			
			<div class="row"> <!-- MAIN ROW -->
					<div  class="col-sm-3"></div>
					<div class="col-sm-6"><!-- MAIN COLLUMN-->
						<!-- Alert Area-->
					      <div class='hidden alert-success alert alert-dismissible' role='alert'>
					        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>    
					        <span class='glyphicon glyphicon-ok'></span> Đăng tin thành công. Hãy đợi phản hồi từ các đội bóng khác.
					      </div>

					      <div class='hidden alert-danger alert alert-dismissible' role='alert'>   
					        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					        <span class='glyphicon glyphicon-exclamation-sign'></span> Đã có lỗi xảy ra. Vui lòng kiểm tra thông tin.
					      </div>

					    <!-- End Alert Area-->

					<div class="panel panel-success"><!-- Form Transactions-->
						<div class="panel-heading"><strong><span class="glyphicon glyphicon-fire"></span> Cáp kèo</strong></div>
						<div class="panel-body">
							<form id="transactionForm">
			                 	<div class="form-group">
			                      <input type="text" name="teamName" class="form-control" id="teamName" size="20" maxlength="80" tabindex="1" placeholder="Tên đội bóng" value="<?php if(isset($team['tname'])) echo $team['tname']; ?>">
			                 	</div>
			                   
								<div class="form-group">
								  <label class="text-success" for="type">Thể thức</label>
								  <div>
								    <select id="type" name="type" class="form-control" tabindex="2">
								    <?php 
								      $selected_type = isset($team['team_type']) ? $team['team_type'] : 5;
								      for($i=5; $i<=11; $i++) {
								        echo "<option value='{$i}'";
								        if($i == $selected_type) {echo "selected='selected'";}
								        echo ">{$i} người</option>";
								      }
								    ?>
								     </select>
								  </div>  
								</div>

			                  	<p class="text-success"><strong>Ngày</strong></p>
								<div class="form-group input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									<input class="form-control" type="text" name="date" id="date" size="20" maxlength="80" tabindex="3">
								</div>

								<p class="text-success"><strong>Giờ bắt đầu</strong></p>
								<div class="form-group input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
									<input name="start_time" id="start_time" type='text' class="form-control" tabindex="4"/>
								</div> 

								<p class="text-success"><strong>Giờ kết thúc</strong></p>
								<div class="form-group input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
									<input class="form-control" type="text" name="end_time" id="end_time" tabindex="5">
								</div>

							    <div class="form-group">
								    <input class="form-control" type="text" name="contactName" id="contactName" size="20" maxlength="80" tabindex="6" placeholder="Tên người liên hệ" value="<?php if(isset($user['first_name'])) echo $user['first_name'] ?>" >
							    </div>

							    <div class="form-group">
								    <input class="form-control" type="tel" name="tel" id="tel" size="20" maxlength="80" tabindex="7" placeholder="Số ĐTDĐ"  value="<?php if(isset($user['phone'])) echo $user['phone'] ?>">
							    </div>

							    <div class="form-group">
								    <input class="form-control" type="text" name="groundName" id="groundName" size="20" maxlength="80" tabindex="8" placeholder="Tên Sân">
							    </div>
			                </form>

							<p class="text-success"><strong>Hãy click vào bản đồ vị trí sân</strong></p>
						   	<input id="pac-input" class="form-control controls" type="text" placeholder="Tìm kiếm khu vực">
		   					<div class="well" id="map" style="width: 100%; height:400px;"></div>

							<a  href="#main" id="postButton" class="btn btn-success btn-block">Loan tin</a>
						</div><!-- End . panel-body -->
					</div><!--END Form Transactions-->

					
					
				</div> <!--end MAIN COLLUMN -->
				<div  class="col-sm-3" data-toggle="modal" data-target="#transactionModal"></div>	
			</div><!-- end MAIN ROW -->

		</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->
<!-- Vietnamese reCaptcha by Google-->
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>

<!-- Moment api -->
<script language="javascript" type="text/javascript" src="js/moment.min.js"></script>
<script language="javascript" type="text/javascript" src="js/moment-vi.js"></script>
<!-- timepicker api-->
<script language="javascript" type="text/javascript" src='js/bootstrap-datetimepicker.min.js'></script>


<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/transactions.js"></script>


<!-- google maps -->
<script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initAutocomplete() {
	//Define location variables
	latitude = null;
	longitude = null;

	//Create new map
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 10.75, lng: 106.6667},
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  //Geolocation
	var infoWindow = new google.maps.InfoWindow({map: map});

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
	  	var pos = {
			lat: position.coords.latitude,
			lng: position.coords.longitude
	  	};

		infoWindow.setPosition(pos);
		infoWindow.setContent('Vị trí của bạn');
		map.setCenter(pos);
	}, function() {
	 	handleLocationError(true, infoWindow, map.getCenter());
	});
	} else {
	// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	}

	
	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	  infoWindow.setPosition(pos);
	  infoWindow.setContent(browserHasGeolocation ?
	                        'Geolocation không hoạt động.' :
	                        'trình duyệt của bạn không hỗ trợ geolocation.');
	}
	//End Geolocation
	
  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  	var markersArray = [];

  	function clearOverlays() {
	  for (var i = 0; i < markersArray.length; i++ ) {
	    markersArray[i].setMap(null);
	  }
	  markersArray.length = 0;
	}

	google.maps.event.addListener(map, 'click', function(event) {
		clearOverlays();
    	placeMarker(event.latLng);

    	//Get location
    	latitude = event.latLng.lat();
	    longitude = event.latLng.lng();
	    console.log( latitude + ', ' + longitude );

	});

	function placeMarker(location) {
	  	var custom_marker = new google.maps.Marker({
	    position: location,
	    map: map
 		});
 		markersArray.push(custom_marker);
	}

}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9VOKyf7VX6d8jGK1OzWa1PydTOJ05IOs&language=vi&libraries=places&callback=initAutocomplete"
         async defer></script>
<script type="text/javascript">

$( document ).ajaxStart(function() {
  $( ".loading" ).show();
});

$( document ).ajaxStop(function() {
  $( ".loading" ).hide();
});

//First name form handling
$('#postButton').click(function() {
	//Create error flag
	var error = [];

	//Check if inputs are fault
	var teamName = $('#teamName').val();
	if(!teamName) {error[0] = 'error';} else {error[0]= null;}

	var type = $('#type option:selected').val();
	if(!type) {error[1] = 'error';} else {error[1]= null;}

	var date = $('#date').val();
	if(!date) {error[2] = 'error';} else {error[2]= null;}

	var start_time = $('#start_time').val();
	if(!start_time) {error[3] = 'error';} else {error[3]= null;}

	var end_time = $('#end_time').val();
	if(!end_time) {error[4] = 'error';} else {error[4]= null;}

	var contactName = $('#contactName').val();
	if(!contactName) {error[5] = 'error';} else {error[5]= null;}

	var tel = $('#tel').val();
	if(!tel) {error[6] = 'error';} else {error[6]= null;}

	var groundName = $('#groundName').val();
	if(!groundName) {error[7] = 'error';} else {error[7]= null;}

	if(!latitude) {error[8] = 'error';} else {error[8]= null;}
	if(!longitude) {error[9] = 'error';} else {error[9]= null;}

	var data = {'teamName': teamName,
				 'type' : type, 
				 'date' : date,
				 'start_time': start_time, 
				 'end_time' : end_time, 
				 'contactName' : contactName, 
				 'tel' : tel, 
				 'groundName' : groundName, 
				 'latitude' : latitude, 
				 'longitude' : latitude
				};

	var execute = true;			
	for (var i = 0; i < 10; i++) {
		if(error[i] != null) {
			execute = false;
			$('.alert-danger').removeClass('hidden');
		}
	};

	//Sending ajax			
	if(execute === true) {
		$.ajax({
		    type: 'post',
		    url: 'processor/post.php',
		    data: {'json': JSON.stringify(data)},
		    success: function(response) {
		        var response = response.trim();
		        console.log(response); 
		        if(response == 'YES') {
		        	$('.alert').addClass('hidden');
           			$('.alert-success').removeClass('hidden');
		        } else if(response == 'NO') {
		        	$('.alert').addClass('hidden');
		        	$('.alert-danger').removeClass('hidden');
		        }	
		    }
		});
	} else {
		console.log(error);
	}
	

});

</script>
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</body>

</html>