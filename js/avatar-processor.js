//Change default options of cropper plugin
$.fn.cropper.setDefaults({aspectRatio: 1});

//Loading image on client-side in order to review
function readURL(input) {
	if(input.files && input.files[0]) {
		//The FileReader object lets web applications asynchronously read the contents of files
		//Return a newly contructed FileReader
		var reader = new FileReader();

		//After file loaded, handling event
		reader.onload = function (e) {
			//Change src attribute by Jquery, e means event
			//target which is the property of e and will return the element that triggered the event
			//The Jquery event.result property contains the last/previous value returned by an event handler triggered by the specified event.
			$('#editImage').cropper('replace', e.target.result);
			
		}
		//The readAsDataURL method is used to read the contents of the specified Blob or File.
		reader.readAsDataURL(input.files[0])
		return true;
		
	} else {
		return false;
	}

}


$('#inputImage').on('change', function() {
	readURL(this);
});
//END Loading image

$('#cropButton').on('click', function() {
	var data = $('#editImage').cropper('getCropBoxData');
	var canvasData = $('#editImage').cropper('getCanvasData');
	alert(canvasData.toSource());
}); 
	


