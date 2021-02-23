<?php
// Gutenberg blocks

// Convert files in folder to array of names
function files_to_array($dir){
	if ($block_fields = scandir( get_theme_file_path($dir) )):
		$block_fields = array_diff( $block_fields, ['.', '..']);
		$block_fields = array_filter( $block_fields, function($file){ if(!is_dir($file)) return $file;  } );
		$names = array();
		foreach( $block_fields as $item ):
			$names[] = str_replace('.php', '', $item);
		endforeach;
		if( !empty($names) ):
			return $names;
		else:
			return false;
		endif;
	else:
		return false;
	endif;
}

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	if( function_exists('acf_register_block') ) {
		if ($block_fields = files_to_array('/blocks/gutenberg/')) {
			foreach ($block_fields as $block_name) {
				$file_path = get_theme_file_path('/blocks/gutenberg/'.$block_name.'.php');
				$file_data = get_file_data($file_path, [ 'title'=>'Block title','description'=>'Description','keywords'=>'Keywords','category'=>'Category','icon'=>'Icon' ]);
				$file_data['keywords'] = explode(', ', $file_data['keywords']);
				$file_data['keywords'] = array_map('trim', $file_data['keywords']);
				//fallback options
				$file_data['title'] = $file_data['title'] ? $file_data['title'] : $block_name;
				$file_data['description'] = $file_data['description'] ? $file_data['description'] : $block_name;
				$file_data['category'] = $file_data['category'] ? $file_data['category'] : 'theme-blocks';
				$file_data['icon'] = $file_data['icon'] ? $file_data['icon'] : 'media-text';
				acf_register_block([
					'name'             => $block_name,
					'title'            => $file_data['title'],
					'description'      => $file_data['description'],
					'render_template'  => $file_path,
					'category'         => $file_data['category'],
					'icon'             => $file_data['icon'],
					'keywords'         => $file_data['keywords'],
					'mode'             => 'edit',
					'align'            => 'full',
					'example'           => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'is_preview'    => true
							)
						)
					),
					'supports'         => [ 'align' => false ]
				]);
			}
		}
	}
}

add_filter( 'block_categories', 'my_plugin_block_categories', 10, 2 );
function my_plugin_block_categories( $categories, $post ) {
	return array_merge($categories,[['slug'   => 'theme-blocks', 'title'  => __( 'Theme blocks', DOMAIN ) ]]);
}

function my_acf_block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
	if( file_exists( get_theme_file_path("/blocks/gutenberg/{$slug}.php") ) ) {
		include( get_theme_file_path("/blocks/gutenberg/{$slug}.php") );
	}
}

function theme_gutenberg_default_block_wrapper( $block_content, $block ) {
	$names = files_to_array('/blocks/gutenberg/');
	$custom_blocks = array();
	foreach( $names as $item ):
		$custom_blocks[] = 'acf/'.$item;
	endforeach;
	$custom_blocks[] = 'core/column';
	$custom_blocks[] = 'core/group';
	
	if (!in_array($block['blockName'], $custom_blocks) ) {
		if ( preg_replace("/\s/", "", $block_content) != '') {
			$block_content = '<div class="g-container">'.$block_content.'</div>';
		}
	}
	return $block_content;
}
add_filter( 'render_block', 'theme_gutenberg_default_block_wrapper', 10, 2 );

function custom_admin_css() {
    echo '<style type="text/css">.wp-block {max-width: 100%;}.wp-block[data-align="wide"] {max-width: 100%;}.wp-block[data-align="full"] {max-width: none;}</style>';
}

add_action('admin_head', 'custom_admin_css');

// Show preview image
function the_preview_image($path){
    $path_ar = explode('/', $path);
    $name = $path_ar[count($path_ar)-1];
    $file_name = str_replace('.php', '', $name);
    $image_jpg =  get_template_directory_uri().'/blocks/gutenberg-preview/'.$file_name.'.jpg';
    $image_png =  get_template_directory_uri().'/blocks/gutenberg-preview/'.$file_name.'.png';
    if( file_exists( get_stylesheet_directory().'/blocks/gutenberg-preview/'.$file_name.'.jpg' ) ):
        $preview = $image_jpg;
    elseif( file_exists( get_stylesheet_directory().'/blocks/gutenberg-preview/'.$file_name.'.png' ) ):
        $preview = $image_png;
    endif;
    if( !empty($preview) ) {
        echo '<img src="' . $preview . '" title="Preview" style="box-shadow: 12px 12px 29px #555;">';
    }
}
