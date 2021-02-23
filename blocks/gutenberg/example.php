<?php /*
Block title: Example
Description: Example block.
Keywords: example
Icon: sort
Other Available options: Icon, Category.
*/ ?>
<?php if($is_preview):
    the_preview_image(__FILE__);
else: ?>
   Your code
<?php endif; ?>
