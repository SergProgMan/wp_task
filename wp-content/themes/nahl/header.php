<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
    <div class="header__top">
        <a class="header__brand brand" href="<?php echo esc_url( home_url() ); ?>">
            <h2 class="header__brand--top"><?php echo get_field('header_logo_top', 'options')?></h2>
            <?php if($header_logo_bottom = get_field('header_logo_bottom', 'options')) :?>
            <span class="header__brand--bottom"><?php echo $header_logo_bottom?></span>
            <?php endif;?>
        </a>
    </div>
    <nav class="header__nav header__bottom navbar navbar-expand-lg navbar-light bg-light">
        <div class="header__container">
<!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primaryNavBar"-->
<!--                    aria-controls="primaryNavBar" aria-expanded="false" aria-label="Toggle navigation">-->
<!--                <span class="navbar-toggler-icon"></span>-->
<!--            </button>-->
            <?php
            if (has_nav_menu('primary')) :
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'container_class' => 'collapse navbar-collapse',
                    'depth' => 4,
                    'container_id' => 'primaryNavBar',
                    'menu_class' => 'navbar-nav',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker' => new nahl_navwalker()
                ]);
            endif;
            ?></div>
    </nav><!-- .nav-primary -->
</header><!-- .banner -->
<main id="content" class="site-content">