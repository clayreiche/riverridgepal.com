jQuery(document).ready(function() {
	
	//Tooltips
	jQuery('#cff-admin .cff-tooltip-link').click(function(){
		jQuery(this).closest('tr').find('.cff-tooltip').slideToggle();
	});

	//Check Access Token length
	jQuery("#cff_access_token").change(function() {

		var cff_token_string = jQuery('#cff_access_token').val(),
			cff_token_check = cff_token_string.indexOf('|');

  		if ( (cff_token_check == -1) && (cff_token_string.length < 50) && (cff_token_string.length !== 0) ) {
  			jQuery('.cff-profile-error.cff-access-token').fadeIn();
  		} else {
  			jQuery('.cff-profile-error.cff-access-token').fadeOut();
  		}

	});

	//Is this a page, group or profile?
	var cff_page_type = jQuery('.cff-page-type select').val(),
		$cff_page_type_options = jQuery('.cff-page-options'),
		$cff_profile_error = jQuery('.cff-profile-error.cff-page-type');

	//Should we show anything initially?
	if(cff_page_type !== 'page') $cff_page_type_options.hide();
	if(cff_page_type == 'profile') $cff_profile_error.show();

	//When page type is changed show the relevant item
	jQuery('.cff-page-type').change(function(){
		cff_page_type = jQuery('.cff-page-type select').val();

		if( cff_page_type !== 'page' ) {
			$cff_page_type_options.fadeOut(function(){
				if( cff_page_type == 'profile' ) {
					$cff_profile_error.fadeIn();
				} else {
					$cff_profile_error.fadeOut();
				}
			});
			
		} else {
			$cff_page_type_options.fadeIn();
			$cff_profile_error.fadeOut();
		}
	});

	//Choose events source
	var $cff_events_source = jQuery('.cff-events-source'),
		checked = jQuery("#post-types input:checkbox:checked");
	
	//Hide page source option initially
	$cff_events_source.hide();

	//Show if only events are checked
	if (checked.length === 1 && checked[0].id === 'cff_show_event_type') {
		$cff_events_source.show();
	}

	//On change check whether only events is checked or not
	jQuery("#post-types").change(function() {
	    var checked = jQuery("#post-types input:checkbox:checked");
	    if (checked.length === 1 && checked[0].id === 'cff_show_event_type') {
	        $cff_events_source.fadeIn();
	    } 
	    else {
	        $cff_events_source.fadeOut();
	    }
	});

	//Header icon
	//Icon type
	//Check the saved icon type on page load and display it
	jQuery('#cff-header-icon-example').removeClass().addClass('fa fa-' + jQuery('#cff-header-icon').val() );
	//Change the header icon when selected from the list
	jQuery('#cff-header-icon').change(function() {
	    var $self = jQuery(this);

	    jQuery('#cff-header-icon-example').removeClass().addClass('fa fa-' + $self.val() );
	});

	//Icon style
	var iconStyles = 'color: #' + jQuery('#cff-header-icon-color').val() + '; font-size: ' + jQuery('#cff-header-icon-size').val() + 'px;';
	jQuery('#cff-header-icon-example').attr('style', iconStyles);

	jQuery('#cff-header-icon-size, #cff-header-icon-color').change(function() {
	    var iconStyles = 'color: #' + jQuery('#cff-header-icon-color').val() + '; font-size: ' + jQuery('#cff-header-icon-size').val() + 'px;';
	    console.log(iconStyles);
	    jQuery('#cff-header-icon-example').attr('style', iconStyles);
	});

	//Test Facebook API connection button
	jQuery('#cff-api-test').click(function(e){
		e.preventDefault();
		var cff_page_id = jQuery('#cff_page_id').val(),
			cff_access_token = jQuery('#cff_access_token').val(),
			response = 'https://graph.facebook.com/' + cff_page_id + '/posts' + '?access_token=' + cff_access_token;

		//Show the loader
		jQuery('.cff-loader').show();

		//Load the response into the text box
		jQuery('#cff-api-test-result textarea').css('display', 'block').load(response, function( response, status, xhr ) {
			//Check for an error
			if ( status == "error" ) {
				var msg = "Error: ";
				jQuery( "#cff-api-test-result textarea" ).html( msg + xhr.status + " " + xhr.statusText + ". Could not connect to Facebook API." ).removeClass().addClass('cff-error');
			} else {
				jQuery('#cff-api-test-result textarea').removeClass().addClass('cff-success');
			}
			//Hide the loader
			jQuery('.cff-loader').hide();
		});
	});


	//If 'Others only' is selected then show a note
	var $cffOthersOnly = jQuery('#cff-others-only');

	if ( jQuery("#cff_show_others option:selected").val() == 'onlyothers' ) $cffOthersOnly.show();
	
	jQuery("#cff_show_others").change(function() {
		if ( jQuery("#cff_show_others option:selected").val() == 'onlyothers' ) {
			$cffOthersOnly.show();
		} else {
			$cffOthersOnly.hide();
		}
	});

});