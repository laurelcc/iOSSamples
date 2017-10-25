jQuery(function($){
	$('body').on('click','.maha-shortcodes.button-primary',function(){
		$.magnificPopup.open({
			mainClass: 'mfp-zoom-in',
			items: {
				src: '#ui-shortcodes-maha'
			},
			type: 'inline',
			removalDelay: 500
		}, 0);
	});
});