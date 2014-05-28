<?php	 	 ?>

	<div id="content" class="widecolumn">

  <?php	 	 ?>

		<div class="navigation">
			<div class="alignleft">&nbsp;</div>
			<div class="alignright">&nbsp;</div>
		</div>
<?php	 	 // This also populates the iconsize for the next line ?>
<?php	 	 // This lets us style narrow icons specially ?>
		<div class="post" id="post-<?php	 	 ?>">
			<h2><a href="<?php	 	 ?></a></h2>
			<div class="entry">
				<p class="<?php	 	 ?></p>

				<?php	 	 ?>

				<?php	 	 ?>

				<p class="postmetadata alt">
					<small>
						This entry was posted
						<?php	 	 /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?> 
						on <?php	 	 the_time() ?>
						and is filed under <?php	 	 the_category(', ') ?>.
						You can follow any responses to this entry through the <?php	 	 ?> feed. 

						<?php	 	 if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php	 	 ?>" rel="trackback">trackback</a> from your own site.

						<?php	 	 } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php	 	 ?> " rel="trackback">trackback</a> from your own site.

						<?php	 	 } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php	 	 } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php	 	 ?>

					</small>
				</p>

			</div>
		</div>

	<?php	 	 ?>

	<?php	 	 else: ?>

		<p>Sorry, no attachments matched your criteria.</p>

<?php	 	 ?>

	</div>

<?php	 	 ?>
