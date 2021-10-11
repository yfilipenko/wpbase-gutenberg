<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
        <!-- set the viewport width and initial-scale on mobile devices -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <!-- set the encoding of your site -->
		<meta charset="<?php bloginfo( 'charset' ); ?>">
        <!-- include custom JavaScript -->
		<script type="text/javascript">
			var pathInfo = {
				base: '<?php echo get_template_directory_uri(); ?>/',
				css: 'css/',
				js: 'js/',
				swf: 'swf/',
			}
		</script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
        <div id="wrapper">
            <!-- header of the page -->
            <header id="header">
                <div class="container">
                    <?php if( is_front_page() ): ?>
                        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else: ?>
                        <strong><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></strong>
                    <?php endif; ?>
​
                    <?php /* Custom logo support. Uncomment or delete on production
                    <?php if ( function_exists( 'the_custom_logo' ) ) : ?>
                        <div class="logo">
                         <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>
                    */ ?>
​
                    <p><q><?php bloginfo( 'description' ); ?></q></p>
​
                    <?php if( has_nav_menu( 'primary' ) )
                        wp_nav_menu( array(
                                'container' => false,
                                'theme_location' => 'primary',
                                'menu_id'        => 'navigation',
                                'menu_class'     => 'navigation',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'walker'         => new Custom_Walker_Nav_Menu
                            )
                        ); ?>
                </div>
            </header>
            <!-- contain main informative part of the site -->
            <main id="main">
