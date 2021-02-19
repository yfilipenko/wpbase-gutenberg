<?php /*
Block title: Example
Description: Example block.
Keywords: example
Icon: sort
Other Available options: Icon, Category.
*/ ?>
<?php if($is_preview): 
    $file_name = get_filename(__FILE__);
    $image_jpg =  get_template_directory_uri().'/blocks/gutenberg-preview/'.$file_name.'.jpg';
    $image_png =  get_template_directory_uri().'/blocks/gutenberg-preview/'.$file_name.'.png';
    if( file_exists( get_stylesheet_directory().'/blocks/gutenberg-preview/'.$file_name.'.jpg' ) ):
        $preview = $image_jpg;
    elseif( file_exists( get_stylesheet_directory().'/blocks/gutenberg-preview/'.$file_name.'.png' ) ):
        $preview = $image_png;
    endif;
    if( !empty($preview) ): ?>
        <img src="<?php echo $preview; ?>" title="Preview" style="box-shadow: 12px 12px 29px #555;">
    <?php endif; ?>
<?php else:
    // Your code
endif; ?>