	<div id="sidebar">
		<ul>
		<li style="background-color:#426918;margin:0;padding:0;"><?php	 	 ?></li>
		<li style="background-color:#426918;margin:0;padding:0;">
			<ul class="favorite">
<li><img alt="rss" src="<?php	 	 ?>">RSS Feed</a></li>
<li><img alt="favorite" src="<?php	 	<a href="#">Favorites</a></li>
</ul>
</li>
<?php	 	 if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

			<li>
			<?php	 	 /* If this is a 404 page */ if (is_404()) { ?>
			<?php	 	 /* If this is a category archive */ } elseif (is_category()) { ?>
			<p>You are currently browsing the archives for the <?php	 	 ?> category.</p>

			<?php	 	 /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p>You are currently browsing the <a href="<?php	 	 ?></a> weblog archives
			for the day <?php	 	 ?>.</p>

			<?php	 	 /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p>You are currently browsing the <a href="<?php	 	 ?></a> weblog archives
			for <?php	 	 ?>.</p>

			<?php	 	 /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p>You are currently browsing the <a href="<?php	 	 ?></a> weblog archives
			for the year <?php	 	 ?>.</p>

			<?php	 	 /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p>You have searched the <a href="<?php	 	 ?></a> weblog archives
			for <strong>'<?php	 	 ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

			<?php	 	 /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>You are currently browsing the <a href="<?php	 	 ?></a> weblog archives.</p>

			<?php	 	 } ?>
			</li>

			<?php	 	 ?>

			<li><h2>Archives</h2>
				<ul>
				<?php	 	 ?>
				</ul>
			</li>
			<?php	 	
			if (function_exists('wp_list_categories')) {
			wp_list_categories('show_count=1&title_li=<h2>Categories</h2>');
			} else {?>
			<li><h2>Categories</h2>
				<ul>
				<?php	 	 ?>
				</ul>
			</li>
			<?php	 	 }
			?> 
	
			<?php	 	 /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
			<?php	 	
			if (function_exists('wp_list_bookmarks')) {
				wp_list_bookmarks();
			} else {
				get_links_list();
			}
			?> 

				<li><h2>Meta</h2>
				<ul>
					<?php	 	 ?>
					<li><?php	 	 ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<li><a href="http://themey.com/">Themes</a></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php	 	 ?>
				</ul>
				</li>
			<?php	 	 } ?>
		<?php	 	 ?>
		</ul>
	</div>

