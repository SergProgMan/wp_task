<?php
/**
* Template Name: Test
*/
wp_head();
?>

<div class="coloredDiv">
    <p>Text</p>
    <?php if( get_field('text') ): ?>
        <?php the_field('text'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Text Area</p>
    <?php if( get_field('text_area') ): ?>
        <?php the_field('text_area'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Number</p>
    <?php if( get_field('number') ): ?>
        <?php the_field('number'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Range</p>
    <?php if( get_field('range') ): ?>
        <?php the_field('range'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Email</p>
    <?php if( get_field('email') ): ?>
        <?php the_field('email'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>URL</p>
    <?php if( get_field('url') ): ?>
        <?php the_field('url'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Image</p>
    <?php 
    $image = get_field('image');
    if( !empty($image) ): 
        // vars
        $url = $image['url'];
        $title = $image['title'];
        $alt = $image['alt'];
        $caption = $image['caption'];
        // thumbnail
        $size = 'thumbnail';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];

        if( $caption ): ?>
            <div class="wp-caption">
        <?php endif; ?>

        <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
            <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
        </a>

        <?php if( $caption ): ?>
                <p class="wp-caption-text"><?php echo $caption; ?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>File</p>
    <?php 
    $file = get_field('file');
    if( $file ): ?>	
	    <a href="<?php echo $file['url']; ?>"><?php echo $file['filename']; ?></a>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>oEmbed</p>
    <?php if( get_field('oembed') ): ?>
        <?php the_field('oembed'); ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Galary</p>
    <?php
    $images = get_field('gallery');
    if( $images ): ?>
        <ul>
            <?php foreach( $images as $image ): ?>
                <li>
                    <a href="<?php echo $image['url']; ?>">
                        <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Select</p>
    <?php
    // vars
    $field = get_field_object('select');
    $value = $field['value'];
    $label = $field['choices'][ $value ];
    ?>
    <p>Color: <span><?php echo $label; ?></span></p>
</div>

<div class="coloredDiv">
    <p>Checkbox</p>
    <?php
    // vars	
    $colors = get_field('checkbox');
    // check
    if( $colors ): ?>
    <ul>
        <?php foreach( $colors as $color ): ?>
            <li><span class="color-<?php echo $color['value']; ?>"><?php echo $color['label']; ?></span></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Radio button</p>  
    <p>Color: <span><?php the_field('radio_button'); ?></span></p>
</div>

<div class="coloredDiv">
    <p>Button group</p>
    <?php
    // vars
    $color = get_field('button_group');
    ?>
    <p>Color: <span><?php echo $color['label']; ?></span></p>
</div>

<div class="coloredDiv">
    <p>True/False</p>  
    <?php if( get_field('true_false') ): ?>	
        <p class="activateScript">Activ</p>
	<?php else : ?>	
        <p>Not activ</p>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Link</p>  
    <?php 
    $link = get_field('link');

    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <a class="button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Post Object</p>  
    <?php
    $post_object = get_field('post_object');
    //var_dump($post_object);
    if( $post_object ): 
        // override $post
        $post = $post_object;
        setup_postdata( $post );
        ?>
        <div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <span>Post Object Custom Field: <?php the_field('post_object'); ?></span>
        </div>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Page Link</p>
    <a href="<?php the_field('page_link'); ?>">Read this!</a>
</div>

<div class="coloredDiv">
    <p>Relationship</p>
    <?php 
    $posts = get_field('relationship');
    if( $posts ): ?>
        <ul>
        <?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
            <li>
                <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
                <!-- <span>Custom field from $post: <?php the_field('author', $p->ID); ?></span> -->
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Taxonomy</p>  
    <?php 
    $terms = get_field('taxonomy');
    if( $terms ): ?>
        <ul>
            <?php foreach( $terms as $term ): ?>
                <h2><?php echo $term->name; ?></h2>
                <p><?php echo $term->description; ?></p>
                <a href="<?php echo get_term_link( $term ); ?>">View all '<?php echo $term->name; ?>' posts</a>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>user</p>  
    <?php 
    $user = get_field('user');
    //var_dump($user);
    if( $user ): ?>
       <p><?php
            foreach($user as $key=>$value){
                echo $key." => ".$value."<br>";
            }
       ?></p>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Google map</p>  
    <?php 
    $location = get_field('google_map');
    if( !empty($location) ):
    ?>
    <div class="acf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Date Picker</p>  
    <?php 
    // get raw date
    $date = get_field('date', false, false);
    // make date object
    $date = new DateTime($date);
    ?>
    <p>Event start date: <?php echo $date->format('j M Y'); ?></p>
    <?php 
    // increase by 1 day
    $date->modify('+1 day');        
    ?>
    <p>Event end date: <?php echo $date->format('j M Y'); ?></p>
</div>

<div class="coloredDiv">
    <p>Date Time Picker</p>  
    <p>Event starts: <?php the_field('date_time_picker'); ?></p>
</div>

<div class="coloredDiv">
    <p>Time Picker</p>  
    <p>Close time: <?php the_field('time_picker'); ?> </p>
</div>

<div style="background-color:<?= the_field('color_picker') ?>" class="special-color">
    <p>Color Picker</p>  
    <?= the_field('color_picker'); ?>;
</div>

<div class="coloredDiv">
    <p>Flexible Content</p>  
    <?php
    // check if the flexible content field has rows of data
    if( have_rows('flexible_content') ):
        // var_dump();
        // loop through the rows of data
        while ( have_rows('flexible_content') ) : the_row();
            if( get_row_layout() == 'content' ):
                echo "<p>".the_sub_field('text_flexible_1')."</p>";
                echo "<p>".the_sub_field('text_flexible_2')."</p>";
                echo "<p>".the_sub_field('image_flexible')."</p>";
            elseif( get_row_layout() == 'content_1' ):
                the_sub_field('number_of_something');
            endif;
        endwhile;
    else :
        // no layouts found
    endif;
    ?>
</div>

<div class="coloredDiv">
    <p>Clone</p>  
    <?php		
    // vars
    $clone = get_field('clone');
    //var_dump($clone);
    if( $clone ): ?>
        <p>Clone text: <?php echo $clone['text']; ?></p>
        <p>Clone number: <?php echo $clone['number']; ?></p>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Repeater</p>  
    <?php		
    // vars
    $repeater = get_field('repeater');
    //var_dump($repeater);
    if( $repeater ):
        foreach($repeater as $rep) : ?>
        <p>Repeater text: <?php echo $rep['repeater_text']; ?></p>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="coloredDiv">
    <p>Group</p>  
    <?php		
    // vars
    $group = get_field('group');

    if( $group ): ?>
        <p>Group text: <?php echo $group['group_text']; ?></p>
        <p>Group number: <?php echo $group['group_number']; ?></p>
    <?php endif; ?>
</div>
