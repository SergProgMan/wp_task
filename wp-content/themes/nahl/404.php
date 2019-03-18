<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
        <?php $hero_background = get_field('hero_background', 'options')?>

        <section class="hero-section single-page hero-404" style="background: url('<?php echo $hero_background ?>')">
            <h3 class="hero-title" data-aos="fade-up"><?php echo get_field('hero_text', 'options')?></h3>
        </section>
		<section id="main" class="site-main" role="main">

			<section class="error-404 not-found container text-center">
				<header class="page-header">
					<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', THEME_TD ); ?></h2>
				</header>

				<div class="page-content">
					<h4>To return to the homepage <a href="<?php echo  get_home_url() ?>">click here</a></h4>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</section><!-- #main -->
	</div><!-- #primary -->

<?php
if (is_404() ){
    ?>
    <style>
        footer{
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
<?php }
get_footer();
