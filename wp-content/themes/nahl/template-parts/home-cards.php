<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.2019
 * Time: 10:49
 */ ?>
<?php  if( have_rows('cards') ):?>
<section class="cards-section">
    <div class="cards-section__container">
        <div class="cards-section__row">
            <?php while ( have_rows('cards') ) : the_row();?>

                <div class="card-wrapper">
                    <?php $link = get_sub_field('link')?>
                    <a href="<?php echo $link['url']?>">


                    <div class="card-item" style="background-image: url('<?php echo get_sub_field('background')?>')" >
                            <div class="card-item__top">
                                <h5><?php echo get_sub_field('title')?></h5>
                            </div>
                            <div class="card-item__bottom">
                                <p><?php echo get_sub_field('text')?></p>
                                 <span class="learn-more"><?php _e('Learn More')?></span>
                            </div>
                    </div>
                    </a>

                </div>
            <?php endwhile;?>
        </div>
    </div>
</section>
<?php endif?>
