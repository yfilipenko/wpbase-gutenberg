(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
        //Your js code
		// jQuery('.plugin-selector').plugin({
			
		// });
    }
    

	// Initialize dynamic block preview (editor).
	// plugin-selector - unique plugin selector
	if(window.acf) {
		window.acf.acf_plugins = window.acf.acf_plugins || [];

		if (window.acf.acf_plugins.indexOf('plugin-selector') < 0) {
			window.acf.acf_plugins.push('plugin-selector');
			window.acf.addAction( 'render_block_preview/type=example', initializeBlock );
		} 
	}

})(jQuery);
