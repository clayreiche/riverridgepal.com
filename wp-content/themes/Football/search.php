<?php	 	 ?>

	<div id="content" class="narrowcolumn">

	<?php	 	 if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<div class="navigation">
			<div class="alignleft"><?php	 	 Previous Entries') ?></div>
			<div class="alignright"><?php	 	') ?></div>
		</div>


		<?php	 	 ?>

			<div class="post">
				<h3 id="post-<?php	 	 ?></a></h3>
				<div class="postmetadata">
	 			<p>Posted in <?php	 	 the_time('F jS, Y') ?> </p>
				<p class="postmetacomment"><?php	 	 ?></p></div>
				
			</div>

		<?php	 	 ?>

		<div class="navigation">
			<div class="alignleft"><?php	 	 Previous Entries') ?></div>
			<div class="alignright"><?php	 	') ?></div>
		</div>

	<?php	 	 else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>

	<?php	 	 ?>

	</div>

<?php	 	 ?>

<?php	 	 ?>