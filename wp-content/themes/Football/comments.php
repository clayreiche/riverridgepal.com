<?php	 	 // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.<p>

			<?php	 	
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<?php	 	 if ($comments) : ?>
	<h3 id="comments"><?php	 	</h3>

	<ol class="commentlist">

	<?php	 	 foreach ($comments as $comment) : ?>

		<li class="<?php	 	 comment_ID() ?>">
			<cite><?php	 	 comment_author_link() ?></cite> Says:
			<?php	 	 if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php	 	 ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php	 	 ?></small>

			<?php	 	 comment_text() ?>

		</li>

	<?php	 	 /* Changes every other comment to a different class */
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';
	?>

	<?php	 	 /* end for each comment */ ?>

	</ol>

 <?php	 	 else : // this is displayed if there are no comments so far ?>

	<?php	 	 if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php	 	 else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php	 	 ?>
<?php	 	 ?>


<?php	 	 if ('open' == $post->comment_status) : ?>

<h3 id="respond">Leave a Reply</h3>

<?php	 	 if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php	 	 ?>">logged in</a> to post a comment.</p>
<?php	 	 else : ?>

<form action="<?php	 	 ?>/wp-comments-post.php" method="post" id="commentform">

<?php	 	 if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php	 	</a></p>

<?php	 	 else : ?>

<p><input type="text" name="author" id="author" value="<?php	 	 ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php	 	 ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php	 	 ?>" size="22" tabindex="2" />
<label for="email"><small>Mail (will not be published) <?php	 	 ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php	 	 ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php	 	 ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php	 	 ?></small></p>-->

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php	 	 ?>" />
</p>
<?php	 	 ?>

</form>

<?php	 	 // If registration required and not logged in ?>

<?php	 	 // if you delete this the sky will fall on your head ?>
