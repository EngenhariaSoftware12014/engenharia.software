$(document).ready(function() {

	var place = 'restaurant';
	$('.' +  place + '-exit').addClass('active');

	$('.active').click(function(e) {
		e.preventDefault();				
		// Location
		var location = $(this).attr('id');
		// Row and Col
		var r = location.substr(1,2), c = location.substr(4,6);
		// Add active class to next and preview of col and row 				
		$('#r' + r + 'c' + c).addClass('active');
		console.log('#r' + r + 'c' + c);
		// Add selected class
		$(this).addClass('selected');
		// Remove active class
		$('.active').removeClass('active');
	});

});