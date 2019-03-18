<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.2019
 * Time: 10:49
 */
?>
<?php $hero_background = get_field('hero_background', 'options')?>

<section class="hero-section" style="background: url('<?php echo $hero_background ?>')">
    <h3 class="hero-title" data-aos="fade-up"><?php echo get_field('hero_text', 'options')?></h3>
</section>

