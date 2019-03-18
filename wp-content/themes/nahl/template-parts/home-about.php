<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.2019
 * Time: 10:49
 */ ?>

    <section class="about-section">
        <div class="about-section__container">
            <div class="about-section__right">
                <div class="about-section__right--bottom">
                    <h1><?php echo get_field('about_title')?></h1>
                    <?php echo get_field('about_content')?>
                </div>
            </div>
            <div class="about-section__left">
                <?php get_sidebar()?>
            </div>
        </div>
    </section>

