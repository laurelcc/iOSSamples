jQuery(document).ready(function($){
	$('.mps-column .row').on('click', function(){
		$('.mps-column .row').removeClass('active');
		$(this).addClass('active');
	});

	$('.mps-column .form-content .reverse').change(function(){
		if ( $(this).prop('checked') == true ) {
			$('.mps-column .row.reverse div:last-child').css({'float':'left','margin-right':'20px'});
			$('.mps-column .row.reverse div:first-child').css({'margin-right':'-3px'});
		} else {
			$('.mps-column .row.reverse div:last-child').css({'float':'none','margin-right':'0px'});
			$('.mps-column .row.reverse div:first-child').css({'margin-right':'17px'});
		}
	});
});