(function($) {

	$('#wpps_menu_wp').on('change', function(){

		if( $(this).prop('checked') ) {
			$('.wpps_menu_wp_sub input').prop('disabled', true);
		} else {
			$('.wpps_menu_wp_sub input').prop('disabled', false);
		}

	});

	$('#wpps_closeCommentsGlobaly').on('change', function(){

		if( $(this).prop('checked') ) {
			$('.wpps_menu_comments_sub input').prop('disabled', true);
		} else {
			$('.wpps_menu_comments_sub input').prop('disabled', false);
		}

	});

	$('#wpps_ga_insert').on('change', function(){

		if( $(this).prop('checked') ) {
			$('input[name="wpps_ga_id"]').prop('disabled', false);
			$('input[name="wpps_ga_universal"]').prop('disabled', false);
		} else {
			$('input[name="wpps_ga_id"]').prop('disabled', true);
			$('input[name="wpps_ga_universal"]').prop('disabled', true);
		}

	});

	$('#wpps_site_icon_logo').on('change', function(){

		if( $(this).prop('checked') ) {
			console.log('checked');
			$('#wpss_custom_login_logo').prop('disabled', true);
		} else {
			console.log('unchecked');
			$('#wpss_custom_login_logo').prop('disabled', false);
		}

	});

	$('#wpps_site_login_url').on('change', function(){

		if( $(this).prop('checked') ) {
			console.log('checked');
			$('#wpps_custom_login_url').prop('disabled', true);
		} else {
			console.log('unchecked');
			$('#wpps_custom_login_url').prop('disabled', false);
		}

	});

	$('#wpps_ga_universal').on('change', function(){

		if( $(this).prop('checked') ) {
			$('.wpps_ga_uni_sub input').prop('disabled', false);
		} else {
			$('.wpps_ga_uni_sub input').prop('disabled', true);
		}

	});

	// Initialise checkbox groups
	if( $('#wpps_menu_wp').prop('checked') ) {
		$('.wpps_menu_wp_sub input').prop('disabled', true);
	}

	if( $('#wpps_closeCommentsGlobaly').prop('checked') ) {
		$('.wpps_menu_comments_sub input').prop('disabled', true);
	}

	if( !$('#wpps_ga_insert').prop('checked') ) {
		$('.wpps_ga_sub input').prop('disabled', true);
	}


})( jQuery );