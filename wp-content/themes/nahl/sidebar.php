<?php
function has_children() {
    global $post;
    return count( get_posts( array('post_parent' => $post->ID, 'post_type' => $post->post_type) ) );
}

?>

<div class="content-sidebar-menu">
    <?php if (has_children() )  :?>
        <a class="page-permalink" href="<?php get_permalink()?>"><?php the_title()?></a>
       <?php echo  wpb_list_child_pages();
    endif; ?>
</div>
<?php if( have_rows('sidebar_links', 'options') ):?>
        <?php while ( have_rows('sidebar_links', 'options') ) : the_row();?>
            <?php $sidebar_link  = get_sub_field('sidebar_link')?>
            <?php $sidebar_link_icon = get_sub_field('sidebar_link_icon')?>
            <a href="<?php echo $sidebar_link['url']?>" target="<?php echo $sidebar_link['target']?>">
                <img src="<?php echo  $sidebar_link_icon['url'] ?>" alt="<?php $sidebar_link_icon['alt'] ?>">
                <?php echo $sidebar_link['title']?>
            </a>
        <?php endwhile;?>
<?php endif; ?>