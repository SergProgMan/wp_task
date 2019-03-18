<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main container" role="main" style="padding-top: 25px ">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile; // End of the loop.
		?>

		</section><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
