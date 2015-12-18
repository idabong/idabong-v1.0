$(document).ready(function() {
$('.rating-tooltip-manual').rating({
  extendSymbol: function () {
    var title;
    $(this).tooltip({
      container: 'body',
      placement: 'bottom',
      trigger: 'manual',
      title: function () {
        return title;
      }
    });
    $(this).on('rating.rateenter', function (e, rate) {
    	switch (rate) {
		    case 1:
		        title = "Yếu";
		        break;
		    case 2:
		        title = "Trung Bình";
		        break;
		    case 3:
		        title = "Khá";
		        break;
		    case 4:
		        title = "Tốt";
		        break;
		    case 5:
		        title = "Rất tốt";
		        break;
		}
      $(this).tooltip('show');
    })
    .on('rating.rateleave', function () {
      $(this).tooltip('hide');
    });
  }

  //Send ajax if rated
  //var rate = $('input').rating('rate');
  
});

});
