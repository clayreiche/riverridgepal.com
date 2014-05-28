jQuery(document).ready(function() {
	//Toggle comments
	jQuery('#cff a.cff-view-comments').click(function(){
		jQuery(this).closest('.cff-item').find('.cff-comments-box').slideToggle();
	});

	//Set paths for query.php
	if (typeof siteURL === 'undefined' || siteURL == '') siteURL = window.location.host + '/wp-content/plugins';
	if (typeof rootPath === 'undefined' || rootPath == '') rootPath = '/';
	var locatefile = true,
		url = siteURL + "/custom-facebook-feed-pro/query.php";
	
	//Loop through each item
	jQuery('#cff .cff-item').each(function(){

		var $self = jQuery(this);

		//Wpautop fix
		if( $self.find('.cff-viewpost-link, .cff-viewpost-facebook, .cff-viewpost').parent('p').length ){
			//Don't unwrap event only viewpost link
			if( !$self.hasClass('event') ) $self.find('.cff-viewpost-link, .cff-viewpost-facebook, .cff-viewpost').unwrap('p');
		}
		if( $self.find('.cff-photo').parent('p').length ){
			$self.find('.cff-photo').unwrap('p');
		}
		if( $self.find('.cff-event-thumb').parent('p').length ){
			$self.find('.cff-event-thumb').unwrap('p');
		}
		if( $self.find('.cff-vidLink').parent('p').length ){
			$self.find('.cff-vidLink').unwrap('p');
		}
		if( $self.find('.cff-link').parent('p').length ){
			$self.find('.cff-link').unwrap('p');
		}
		if( $self.find('.cff-viewpost-link').parent('p').length ){
			$self.find('.cff-viewpost-link').unwrap('p');
		}
		if( $self.find('.cff-viewpost-facebook').parent('p').length ){
			$self.find('.cff-viewpost-facebook').unwrap('p');
		}

		if( $self.find('iframe').parent('p').length ){
			$self.find('iframe').unwrap('p');
		}
		if( $self.find('.cff-author').parent('p').length ){
			$self.find('.cff-author').eq(1).unwrap('p');
			$self.find('.cff-author').eq(1).remove();
		}
		$self.find('.cff-view-comments').eq(1).remove();

		//Expand post
		var	expanded = false,
			$post_text = $self.find('.cff-post-text .cff-text'),
			text_limit = $self.closest('#cff').attr('rel');
		if (typeof text_limit === 'undefined' || text_limit == '') text_limit = 99999;
		
		//If the text is linked then use the text within the link
		if ( $post_text.find('a.cff-post-text-link').length ) $post_text = $self.find('.cff-post-text .cff-text a');
		var	full_text = $post_text.html();
		if(full_text == undefined) full_text = '';
		var short_text = full_text.substring(0,text_limit);
		
		//Cut the text based on limits set
		$post_text.html( short_text );
		//Show the 'See More' link if needed
		if (full_text.length > text_limit) $self.find('.cff-expand').show();
		//Click function
		$self.find('.cff-expand a').click(function(e){
			e.preventDefault();
			var $expand = jQuery(this),
				$more = $expand.find('.cff-more'),
				$less = $expand.find('.cff-less');
			if (expanded == false){
				$post_text.html( full_text );
				expanded = true;
				$more.hide();
				$less.show();
			} else {
				$post_text.html( short_text );
				expanded = false;
				$more.show();
				$less.hide();
			}
		});

		//AJAX
		//Set the path to query.php
		var post_id = $self.attr('id'),
			url = siteURL + "/custom-facebook-feed-pro/query.php?id=" + post_id + "&path=" + rootPath;

		//If the file can be found then load in likes and comments
		if (locatefile == true){
			var $likesCountSpan = $self.find('.cff-likes .cff-count'),
				$commentsCountSpan = $self.find('.cff-comments .cff-count');

			//If the likes or comment counts are above 25 then replace them with the query.php values
			if( $likesCountSpan.find('.cff-replace').length ) $likesCountSpan.load(url + '&type=likes');
			if( $commentsCountSpan.find('.cff-replace').length ) $commentsCountSpan.load(url + '&type=comments');

			var $likesCount = $self.find('.cff-comment-likes .cff-comment-likes-count');
			if( $likesCount.length ) {
				$likesCount.load(url + '&type=likes', function(){
					$likesCount.text( $likesCount.text() -2 );
				});
			}
		} else {
			$self.find('.cff-replace').show();
			$self.find('.cff-loader').hide();
		}


		//Only show 4 latest comments
		var $showMoreComments = $self.find('.cff-show-more-comments'),
			$comment = $self.find('.cff-comment');

		if ( $showMoreComments.length ) {
			$comment.hide();
			var commentCount = $comment.length;
			//Show latest 4 comments
			$comment.slice(commentCount-4).show();
			//Show all on click
			$showMoreComments.click(function(){
				$comment.show();
				jQuery(this).hide();
			});
		}


		//If a shared link image is 1x1 (after it's loaded) then hide it and add class (as php check for 1x1 doesn't always work)
		$self.find('.cff-link img').load(function() {
			var $cffSharedLink = $self.find('.cff-link');
			if( $cffSharedLink.find('img').width() < 2 ) {
				$cffSharedLink.hide().siblings('.cff-text-link').addClass('cff-no-image');
			}
		});

	});

});