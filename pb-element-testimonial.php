<?php

	/*	

	*	Goodlayers Item For Page Builder

	*/

	
add_action('plugins_loaded', 'gdlr_core_portfolio_add_pb_element');
if( !function_exists('gdlr_core_portfolio_add_pb_element') ){
	function gdlr_core_portfolio_add_pb_element(){

		if( class_exists('gdlr_core_page_builder_element') ){
			gdlr_core_page_builder_element::add_element('testimonial', 'gdlr_core_pb_element_testimonial'); 
		}
		
	}
}

 
  

if( !class_exists('gdlr_core_pb_element_testimonial') ){

    class gdlr_core_pb_element_testimonial{

        // get the element settings

        static function get_settings(){

            return array(

                'icon' => 'fa-quote-right',

                'title' => esc_html__('MS Testimonial', 'goodlayers-core')

            );

		}
		
		static function get_options(){
			global $gdlr_core_item_pdb;
			
			return array(
				'general' => array(
					'title' => esc_html__('General', 'goodlayers-core'),
					'options' => array(
						'title' => array(
							'title' => esc_html__('Title', 'goodlayers-core'),
							'type' => 'text',
							'default' => esc_html__('Sample Testimonial Title', 'goodlayers-core'),
						),
						'title-left-icon' => array(
							'title' => esc_html__('Title Left Icon ( Only for centered title style )', 'goodlayers-core'),
							'type' => 'icons',
							'allow-none' => true,
							'wrapper-class' => 'gdlr-core-fullsize',
						),
						'caption' => array(
							'title' => esc_html__('Caption ( Only for center style )', 'goodlayers-core'),
							'type' => 'text'
						),
						'tabs' => array(
							'title' => esc_html__('Add Testimonial Tab', 'goodlayers-core'),
							'type' => 'custom',
							'item-type' => 'tabs',
							'wrapper-class' => 'gdlr-core-fullsize',
							'options' => array(
								'title' => array(
									'title' => esc_html__('Name', 'goodlayers-core'),
									'type' => 'text'
								),
								'position' => array(
									'title' => esc_html__('Position', 'goodlayers-core'),
									'type' => 'text'
								),
								'content' => array(
									'title' => esc_html__('Content', 'goodlayers-core'),
									'type' => 'textarea'
								),
								'image' => array(
									'title' => esc_html__('Author Image', 'goodlayers-core'),
									'type' => 'upload'
								),
								'rating' => array(
									'title' => esc_html__('Rating ( Fill number 1 to 10 )', 'goodlayers-core'),
									'type' => 'text'
								),
							),
							'default' => array(
								array(
									'title' => esc_html__('Sameple Name', 'goodlayers-core'),
									'position' => esc_html__('Sample Position', 'goodlayers-core'),
									'content' => esc_html__('Sample testimonial content area', 'goodlayers-core'),
									'image' => '',
								),
								array(
									'title' => esc_html__('Sameple Name', 'goodlayers-core'),
									'position' => esc_html__('Sample Position', 'goodlayers-core'),
									'content' => esc_html__('Sample testimonial content area', 'goodlayers-core'),
									'image' => '',
								),
							)
						),
					),
				),
				'style' => array(
					'title' => esc_html__('Style', 'goodlayers-core'),
					'options' => array(
						'style' => array(
							'title' => esc_html__('Testimonial Style', 'goodlayers-core'),
							'type' => 'radioimage',
							'options' => array(
								'left' => GDLR_CORE_URL . '/include/images/testimonial/left.png',
								'left-2' => GDLR_CORE_URL . '/include/images/testimonial/left-2.jpg',
								'center' => GDLR_CORE_URL . '/include/images/testimonial/center.png',
								'right' => GDLR_CORE_URL . '/include/images/testimonial/right.png',
							),
							'default' => 'left',
							'wrapper-class' => 'gdlr-core-fullsize'
						),
						'with-frame' => array(
							'title' => esc_html__('With Frame', 'goodlayers-core'),
							'type' => 'checkbox',
							'default' => 'disable'
						),
						'column' => array(
							'title' => esc_html__('Column Number', 'goodlayers-core'),
							'type' => 'combobox',
							'options' => array( 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6),
							'default' => 3
						),
						'thumbnail-size' => array(
							'title' => esc_html__('Thumbnail Size', 'goodlayers-core'),
							'type' => 'combobox',
							'options' => 'thumbnail-size',
							'default' => 'thumbnail',
						),
						'enable-quote' => array(
							'title' => esc_html__('Enable Testimonial Quote', 'goodlayers-core'),
							'type' => 'checkbox',
							'default' => 'enable'
						),
						'carousel' => array(
							'title' => esc_html__('Enable Carousel', 'goodlayers-core'),
							'type' => 'checkbox',
							'default' => 'disable'
						),
						'carousel-autoslide' => array(
							'title' => esc_html__('Autoslide Carousel', 'goodlayers-core'),
							'type' => 'checkbox',
							'default' => 'enable',
							'condition' => array( 'carousel' => 'enable' )
						),
						'carousel-scrolling-item-amount' => array(
							'title' => esc_html__('Carousel Scrolling Item Amount', 'goodlayers-core'),
							'type' => 'text',
							'default' => '1',
							'condition' => array( 'carousel' => 'enable' )
						),
						'carousel-navigation' => array(
							'title' => esc_html__('Carousel Navigation', 'goodlayers-core'),
							'type' => 'combobox',
							'options' => array(
								'none' => esc_html__('None', 'goodlayers-core'),
								'navigation' => esc_html__('Only Navigation', 'goodlayers-core'),
								'bullet' => esc_html__('Only Bullet', 'goodlayers-core'),
								'both' => esc_html__('Both Navigation and Bullet', 'goodlayers-core'),
							),
							'default' => 'navigation',
							'condition' => array( 'carousel' => 'enable' )
						),
						'carousel-nav-style' => array(
							'title' => esc_html__('Carousel Nav Style', 'goodlayers-core'),
							'type' => 'combobox',
							'options' => array(
								'default' => esc_html__('Default', 'goodlayers-core'),
								'gdlr-core-plain-style gdlr-core-small' => esc_html__('Small Plain Style', 'goodlayers-core'),
								'gdlr-core-plain-style' => esc_html__('Plain Style', 'goodlayers-core'),
								'gdlr-core-plain-circle-style' => esc_html__('Plain Circle Style', 'goodlayers-core'),
								'gdlr-core-round-style' => esc_html__('Large Round Style', 'goodlayers-core'),
								'gdlr-core-rectangle-style' => esc_html__('Rectangle Style', 'goodlayers-core'),
								'gdlr-core-rectangle-style gdlr-core-large' => esc_html__('Large Rectangle Style', 'goodlayers-core'),
							),
							'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('navigation','both') )
						),
						'carousel-bullet-style' => array(
							'title' => esc_html__('Carousel Bullet Style', 'goodlayers-core'),
							'type' => 'combobox',
							'options' => array(
								'default' => esc_html__('Default', 'goodlayers-core'),
								'cylinder' => esc_html__('Cylinder', 'goodlayers-core'),
							),
							'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('bullet','both') )
						)
					)
				),
				'typography' => array(
					'title' => esc_html__('Typograhy', 'goodlayers-core'),
					'options' => array(
						'title-size' => array(
							'title' => esc_html__('Title Size', 'goodlayers-core'),
							'type' => 'fontslider',
							'default' => '28px'
						),
						'title-text-transform' => array(
							'title' => esc_html__('Title Text Transform', 'goodlayers-core'),
							'type' => 'combobox',
							'data-type' => 'text',
							'options' => array(
								'none' => esc_html__('None', 'goodlayers-core'),
								'uppercase' => esc_html__('Uppercase', 'goodlayers-core'),
								'lowercase' => esc_html__('Lowercase', 'goodlayers-core'),
								'capitalize' => esc_html__('Capitalize', 'goodlayers-core'),
							),
							'default' => 'uppercase'
						),
						'title-font-weight' => array(
							'title' => esc_html__('Title Font Weight', 'goodlayers-core'),
							'type' => 'text',
						),
						'title-letter-spacing' => array(
							'title' => esc_html__('Title Letter Spacing', 'goodlayers-core'),
							'type' => 'text',
							'data-input-type' => 'pixel',
						),
						'name-size' => array(
							'title' => esc_html__('Name Size', 'goodlayers-core'),
							'type' => 'text',
							'data-input-type' => 'pixel',
							'default' => ''
						),
						'caption-size' => array(
							'title' => esc_html__('Position Size', 'goodlayers-core'),
							'type' => 'fontslider',
							'default' => '16px'
						),
						'content-size' => array(
							'title' => esc_html__('Content Size', 'goodlayers-core'),
							'type' => 'fontslider',
							'default' => '15px'
						)
					)
				),				
				'color' => array(
					'title' => esc_html__('Color', 'goodlayers-core'),
					'options' => array(
						'title-color' => array(
							'title' => esc_html__('Title Color', 'goodlayers-core'),
							'type' => 'colorpicker'
						),
						'caption-color' => array(
							'title' => esc_html__('Caption Color', 'goodlayers-core'),
							'type' => 'colorpicker'
						),
						'quote-color' => array(
							'title' => esc_html__('Quote Color', 'goodlayers-core'),
							'type' => 'colorpicker'
						),
						'content-color' => array(
							'title' => esc_html__('Content Color', 'goodlayers-core'),
							'type' => 'colorpicker'
						),
						'name-color' => array(
							'title' => esc_html__('Name Color', 'goodlayers-core'),
							'type' => 'colorpicker'
						),
						'position-color' => array(
							'title' => esc_html__('Position Color', 'goodlayers-core'),
							'type' => 'colorpicker'
						)
					)
				),
				'spacing' => array(
					'title' => esc_html__('Spacing', 'goodlayers-core'),
					'options' => array(
						'caption-spaces' => array(
							'title' => esc_html__('Space Between Caption ( And Title )', 'goodlayers-core'),
							'type' => 'text',
							'data-input-type' => 'pixel',
							'default' => ''
						),
						'title-wrap-bottom-margin' => array(
							'title' => esc_html__('Title Wrap Bottom Margin', 'goodlayers-core'),
							'type' => 'text',
							'data-input-type' => 'pixel',
						),
						'content-bottom-padding' => array(
							'title' => esc_html__('Content Bottom Margin', 'goodlayers-core'),
							'type' => 'text',
							'data-input-type' => 'pixel',
							'default' => '0px'
						),
						'padding-bottom' => array(
							'title' => esc_html__('Padding Bottom ( Item )', 'goodlayers-core'),
							'type' => 'text',
							'data-input-type' => 'pixel',
							'default' => $gdlr_core_item_pdb
						)
					)
				)
			);
		}


    }

}