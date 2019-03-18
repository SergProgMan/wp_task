<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */

get_header(); ?>

	<section id="primary" class="content-area">
        <?php $hero_background = get_field('hero_background', 'options')?>

        <section class="hero-section single-page hero-404" style="background: url('<?php echo $hero_background ?>')">
            <h3 class="hero-title" data-aos="fade-up"><?php echo get_field('hero_text', 'options')?></h3>
        </section>
		<section id="main" class="container site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', THEME_TD ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</section><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
