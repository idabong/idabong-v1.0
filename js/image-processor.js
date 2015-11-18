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
			$('#imgReview').attr('src', e.target.result);
		}

		//The readAsDataURL method is used to read the contents of the specified Blob or File.
		reader.readAsDataURL(input.files[0]);
	}

}

$('#userAvatar').change(function() {
	readURL(this);
});