<?php	 	 ?>
<?php	 	 ?>
	<div id="content" class="narrowcolumn">

	<?php	 	 if (have_posts()) : ?>

		<?php	 	 ?>
		
			<div class="post" id="post-<?php	 	 ?>">
				<h2><a href="<?php	 	 ?></a></h2>
				<img alt="" class="ball" src="<?php	 	 ?>/images/ball.jpg" />
				<div class="postmetadata">
	 			<p>Posted in <?php	 	 the_time('F jS, Y') ?> </p>
				<p class="postmetacomment"><?php	 	 ?></p></div>
				
				<div class="entry">
					<?php	 	 ?>
				</div>
			
			</div>

		<?php	 	 ?>

		<div class="navigation">
			<div class="alignleft"><?php	 	 Previous Entries') ?></div>
			<div class="alignright"><?php	 	') ?></div>
		</div>

	<?php	 	 else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php	 	 ?>

	<?php	 	 ?>

	</div>

<?php	 	 ?>
