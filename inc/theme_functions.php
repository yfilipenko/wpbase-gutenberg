<?php
// Theme functions

//Add class on body
add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( is_page() or is_single() ) {
        $post = get_post(); 
        $blocks = parse_blocks( $post->post_content );
        if ($blocks) {
            $start = substr($blocks[0]['blockName'], 0, 3);
            if ( $start == 'acf' ) {
                $classes[] = 'no-space';
            }
        }
    }
    return $classes;
}

function get_filename($path){
    $path_ar = explode('/', $path);
    $name = $path_ar[count($path_ar)-1];
    $name = str_replace('.php', '', $name);
    return $name;
}