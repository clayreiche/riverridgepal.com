<?php	 	 ?>
<?php	 	 ?>
	<div id="content" class="narrowcolumn">

		<?php	 	 if (have_posts()) : ?>

		 <?php	 	 // Hack. Set $post so that the_date() works. ?>
<?php	 	 /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">Archive for the &#8216;<?php	 	 Category</h2>

 	  <?php	 	 /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archive for <?php	 	 ?></h2>

	 <?php	 	 /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php	 	 ?></h2>

		<?php	 	 /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php	 	 ?></h2>

	  <?php	 	 /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author Archive</h2>

		<?php	 	 /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2>

		<?php	 	 } ?>


		<?php	 	 ?>
		<div class="post">
				<h3 id="post-<?php	 	 ?></a></h3>
				<img alt="" class="ball" src="<?php	 	 ?>/images/ball.jpg" />
				<div class="postmetadata">
	 			<p>Posted in <?php	 	 the_time('F jS, Y') ?> </p>
				<p class="postmetacomment"><?php	 	 ?></p></div>
				
				<div class="entry">
					<?php	 	 the_content() ?>
				</div>

			</div>

		<?php	 	 ?>

		<div class="navigation">
			<div class="alignleft"><?php	 	 Previous Entries') ?></div>
			<div class="alignright"><?php	 	') ?></div>
		</div>

	<?php	 	 else : ?>

		<h2 class="center">Not Found</h2>
		<?php	 	 ?>

	<?php	 	 ?>

	</div>


<?php	 	 ?>
