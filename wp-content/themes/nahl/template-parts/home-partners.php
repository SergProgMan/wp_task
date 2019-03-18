<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.2019
 * Time: 12:22
 */ ?>

<?php if( have_rows('partners') ):?>
    <section class="partners-section">
        <div class="partners-section__container">
            <div class="partners-section--border">
                <?php while (have_rows('partners')) : the_row(); ?>
                    <?php $partners_image = get_sub_field('partners_image') ?>
                    <a target="_blank" href="<?php echo get_sub_field('partners_link') ?>">
                        <img src="<?php echo $partners_image['url'] ?>" alt="<?php echo $partners_image['alt'] ?>">
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php endif; ?>