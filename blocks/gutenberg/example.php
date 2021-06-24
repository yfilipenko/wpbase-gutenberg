<?php /*
Block title: Example
Description: Example block.
Keywords: example
Icon: sort
Other Available options: Icon, Category.
*/ ?>
<?php $className = 'example';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
} ?>
<div class="<?php echo esc_attr($className); ?>">
    
</div>
