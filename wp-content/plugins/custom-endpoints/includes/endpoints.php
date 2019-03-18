<?php


//get fields from home page
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'home/',array(
        'methods'  => 'GET',
        'callback' => 'get_home_page'
    ));
});

function get_home_page($request) {
    if($frontpage_id = get_option( 'page_on_front' )){
        $fields = get_fields($frontpage_id);
        return $fields;
    };
}

//get hot cars
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'cars-hot/',array(
        'methods'  => 'GET',
        'callback' => 'get_featured_cars'
    ));
});

function get_featured_cars($request) {
    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'car',
        'meta_query'	=> array(
            array(
                'key'	  	=> 'hot',
                'value'	  	=> '1',
                'compare' 	=> 'LIKE',
            ),
        ),
    ));
    $arr = [];
    if($posts){
        foreach( $posts as $key=>$post ){
            $arr[] = array_merge((array)$post, get_fields($post->ID)) ;
            $arr[$key]['f_img_url'] = get_the_post_thumbnail_url($post->ID);
            $arr[$key]['url'] = get_post_permalink($post);
            $arr[$key]['brand'] = get_the_terms($post, 'brand')[0]->name;
            $arr[$key]['model'] = get_the_terms($post, 'brand')[1]->name;
            $arr[$key]['engine'] = get_the_terms($post, 'engine')[0]->name;
        }
        return $arr;
    }
}

//get all showrooms with selected fields
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'showrooms/',array(
        'methods'  => 'GET',
        'callback' => 'get_showrooms'
    ));
});

function get_showrooms($request) {
    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'showroom',
    ));
    //return $posts;
    if($posts){
        //list of fields to get
        $selected_fields = [
            "ID",
            "post_title",
            "post_name"
        ];
        //flip
        $fields = array_flip($selected_fields);
        $arr = [];

        foreach($posts as $key=>$post){
            $arr[$key] = array_intersect_key((array)$post,$fields);
            $arr[$key]['url'] = get_post_permalink($post);
        }
        return $arr;
    }
}

//get single showroom by ID
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'showroom/(?P<id>\d+)',array(
        'methods'  => 'GET',
        'callback' => 'get_showroom'
    ));
});

function get_showroom($request) {
    $id = $request['id'];
    $post = get_post($id);
    if($post){
        $responce = [];
        $fields = get_fields($post);
        $responce = array_merge((array)$post, $fields);

        $args = array(
            'taxonomy' => 'showroom_type',
            //  'hide_empty' => true,
            // 'number' => '1',
            'object_ids' => $post->ID,
            // 'parent' => '0',
        );
        $terms = get_terms($args);
        $responce ['terms']= $terms;
        return $responce;

        //list of fields to get
        $selected_fields = [
            "ID",
            "post_title",
            "post_name"
        ];
        //flip
        $fields = array_flip($list_of_fields);
        $arr = [];

        foreach($posts as $key=>$post){
            $arr[] = array_intersect_key((array)$post,$fields);
        }
        return $arr;
    }
}


//get showrooms by taxonomy
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'showrooms/(?P<slug>\w+)',array(
        'methods'  => 'GET',
        'callback' => 'getShowroomsTax'
    ));
});

function getShowroomsTax($request) {
   
    $args = array(
        'taxonomy' => 'showroom_type',
        // 'taxonomy' => 'services',
        // services
    );    
    $termsT= get_terms($args);

    $arr = [];
    foreach ($terms as $term){
        if($term->slug == $request['slug']){
            $arr[] = $term;
        }
    }


    return $arr;
}

//get all cars
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'cars/',array(
        'methods'  => 'GET',
        'callback' => 'get_cars'
    ));
});

function get_cars($request) {
    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'car',
    ));
    if($posts){       
        $arr = [];
        foreach($posts as $key=>$post){
            $arr[] = array_merge((array)$post, get_fields($post->ID)) ;
            $arr[$key]['f_img_url'] = get_the_post_thumbnail_url($post->ID);
            $arr[$key]['url'] = get_post_permalink($post);
            $arr[$key]['brand'] = get_the_terms($post, 'brand')[0]->name;
            $arr[$key]['model'] = get_the_terms($post, 'brand')[1]->name;
            $arr[$key]['engine'] = get_the_terms($post, 'engine')[0]->name;
        }
        return $arr;
    }
}

//get cars by taxonomy
add_action('rest_api_init', function () {
    register_rest_route( 'starter/v1', 'cars/(?P<slug>\w+)',array(
        'methods'  => 'GET',
        'callback' => 'getCarsTax'
    ));
});


//doesn't work
function getCarsTax($request) {
    
    //$custom_terms = get_terms($request['slug']);
    //return $custom_terms;

   // foreach($custom_terms as $custom_term) {
        // wp_reset_query();
        // $args = array('post_type' => 'car',
        //     'tax_query' => array(
        //         array(
        //             'taxonomy' => $request['slug'],
        //             'field' => 'slug',
        //             'terms' => $['slug'],
        //         ),
        //     ),
        // );

        // $loop = new WP_Query($args);

        // if($loop->have_posts()) {
        //     $arr = [];
        //     while($loop->have_posts()) {
        //         $loop->the_post();
        //         $arr[] = $post;
        //     } 
        //     return $arr;
        // }
}

