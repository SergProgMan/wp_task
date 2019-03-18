<?php

get_header(); ?>
<?php $hero_background = get_field('hero_background', 'options')?>

    <section class="hero-section single-page" style="background: url('<?php echo $hero_background ?>')">
        <h3 class="hero-title" data-aos="fade-up"><?php echo get_field('hero_text', 'options')?></h3>
    </section>
    <section class=" single-page about-section ">
        <div class="single-page__container about-section__container ">
            <div class="single__right about-section__right ">
                <div class="single__right--bottom about-section__right--bottom ">
                    <h1><?php echo get_field('page_title')?></h1>
                    <?php  the_content()?>
                </div>
            </div>
            <div class="single__left about-section__left ">
                <?php get_sidebar()?>
            </div>
        </div>

    </section>
<?php
get_footer();
