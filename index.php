<?php
$title = 'Cáp kèo đá bóng'; include 'includes/header.php';
//Fetch team data
if(isset($_SESSION['uid'])) {
	$team = fetch_team($_SESSION['uid']);
}
?>
	<div id="content">
			
			<div class="row"> <!-- MAIN ROW -->
				<div class="col-sm-8"><!-- MAIN COLLUMN-->
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

				    <div class="panel panel-success"><!--Team Avatar Form-->
						<div class="panel-heading"><strong><span class="glyphicon glyphicon-map-marker"></span> Các kèo sắp diễn ra</strong></div>
						<div class="panel-body">
						   	<input id="pac-input" class="form-control controls" type="text" placeholder="Tìm kiếm khu vực">
		   					<div class="well" id="map" style="width: 100%; height:400px;"></div>
	   					</div><!-- End . panel-body -->
					</div><!--END Team Avatar Form-->
				</div><!-- End .col-sm-6 -->
				

				<div  class="col-sm-4" >
					<!-- POST#5 -->
					<div class="panel panel-success">
						<div class="panel-heading"><strong><span class="glyphicon glyphicon-map-marker"></span> Kèo đang chọn</strong></div>

						<div class="panel-body">
								<div class="media">
									<div class="media-left">
									    <a href="#">
									    	<img src="uploads/images/team-avatar-5.png" alt="team avatar">
									    </a>
								 	</div>

									<div class="media-body">
									    <h4 class="media-heading text-success"><strong>Team Name 5</strong></h4>
									    <div>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    	<a href="#"><span class="glyphicon glyphicon-star yellow"></span></a>
									    </div>
									</div>
								</div><!--end div.media-->

								<p class="text" ><strong>Thể thức</strong>: 9 người</p>
								<p class="text"><strong>Ngày</strong>:  <span class="text-danger">dd/mm/yyyy - Day of Week</span> 
								<p class="text"><strong>Giờ</strong>: <span class="text-danger">17h30</span> đến <span class="text-danger">19h00</span></p>
								<p class="text"><strong>Sân Thi Đấu</strong>: Cảng Dầu Khí</p>
								<p class="text"><strong>Địa chỉ</strong>: Số 00 Đường 30/4 TP Vũng Tàu</p>
								<p class="text"><strong>Liên Hệ</strong>: 0000000000 - <span>Mananger's Name</span></p>

								
							<!-- Button for sending request -->
							<a href="#" target="_blank" class="btn btn-warning btn-block">Gửi Yêu Cầu</a>
						</div>
					</div><!--end POST#5-->
				</div>
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

  //*******Show Markers where matchs will happen********//
  // Change this depending on the name of your PHP file
	downloadUrl("processor/xml-markers.php", function(data) {
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName("marker");
		for (var i = 0; i < markers.length; i++) {
			var id = markers[i].getAttribute("id");
			var name = markers[i].getAttribute("name");
			var point = new google.maps.LatLng(
			  parseFloat(markers[i].getAttribute("lat")),
			  parseFloat(markers[i].getAttribute("lng")));
			var marker = new google.maps.Marker({
				map: map,
				position: point
			});
			bindInfoWindow(marker, map, infoWindow);
		}
	});


    function bindInfoWindow(marker, map, infoWindow) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
  //*******End show markers**********//

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

</script>
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</body>

</html>