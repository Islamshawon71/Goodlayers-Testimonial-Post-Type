<?php

	/*	

	*	Goodlayers Item For Page Builder

	*/

	
add_action('plugins_loaded', 'gdlr_core_ms_testimonial_add_pb_element');
if( !function_exists('gdlr_core_ms_testimonial_add_pb_element') ){
	function gdlr_core_ms_testimonial_add_pb_element(){

		if( class_exists('gdlr_core_page_builder_element') ){
			gdlr_core_page_builder_element::add_element('ms_testimonial', 'gdlr_core_pb_element_ms_testimonial'); 
		}
		
	}
}

 
  

if( !class_exists('gdlr_core_pb_element_ms_testimonial') ){

    class gdlr_core_pb_element_ms_testimonial{

        // get the element settings

        static function get_settings(){

            return array(

                'icon' => 'fa-quote-right',

                'title' => esc_html__('MS Testimonial', 'goodlayer-ms-testimonial')

            );

		}
		
		static function get_options(){
			global $gdlr_core_item_pdb;
			
			return array(
				'general' => array(
					'title' => esc_html__('General', 'goodlayer-ms-testimonial'),
					'options' => array(
						'title' => array(
							'title' => esc_html__('Title', 'goodlayer-ms-testimonial'),
							'type' => 'text',
							'default' => esc_html__('Sample Testimonial Title', 'goodlayer-ms-testimonial'),
						),
						'category' => array(
							'title' => esc_html__('Category', 'goodlayer-ms-testimonial'),
							'type' => 'combobox',
							'options' => gdlr_core_get_term_list('ms_testimonial_category'),
							'description' => esc_html__('You can use Ctrl/Command button to select multiple items or remove the selected item. Leave this field blank to select all items in the list.', 'goodlayer-ms-testimonial'),
						),
						'order' => array(
							'title' => esc_html__('Order', 'goodlayer-ms-testimonial'),
							'type' => 'combobox',
							'options' => array(
								'desc'=>esc_html__('Descending Order', 'goodlayer-ms-testimonial'), 
								'asc'=> esc_html__('Ascending Order', 'goodlayer-ms-testimonial'), 
							)
						), 
					)
				)
			);
		} 
		static function get_preview( $settings = array() ){
		 	$content = "";
			$id = mt_rand(0, 9999); 
			ob_start();
			?><script id="gdlr-core-preview-title-<?php echo esc_attr($id); ?>" >
				jQuery(document).ready(function(){
					jQuery('[data-type="ms_testimonial"] .gdlr-core-page-builder-item-container-preview').html("<p style='text-align:center;'>Moresailing Custom Testimonial </p>");
				});
			</script><?php	
			$content .= ob_get_contents();
			ob_end_clean(); 
			return $content;
		}

		static function get_content( $settings = array(), $preview = false ){
			global $gdlr_core_item_pdb; 
			var_dump($settings); 
			
			if(isset($settings['order'])){
				$settings['order'] = 'asc';
			}

			  $posts_array = get_posts(
				array(
					'numberposts'       => -1,
					'post_type' => 'ms_testimonial',
					'order'            => $settings['order'],
					'tax_query' => array(
						array(
							'taxonomy' => 'ms_testimonial_category',
							'field' => 'term_name',
							'terms' => $settings['category']
						)
					)
				)
			); 
			// var_dump($posts_array);
			 $content = "";
			 ob_start(); ?>

			<div class="ms_testimonial">

			<?php foreach ($posts_array as $post) { ?>
				<div class="gdlr-core-pbf-column gdlr-core-column-15 ">
					<div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
						<div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
							<div class="gdlr-core-pbf-element">
								<div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-center-align">
									<div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" style="border-width: 0px;">
										<?php  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );  ?>	
										<img src="<?php echo   $image['0']; ?>" alt="" width="530" height="530" title="small-day">
									</div>
								</div>
							</div> 
							<div class="gdlr-core-pbf-element">
								<div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
									<div class="gdlr-core-text-box-item-content" style="text-transform: none ;">
										<div class="day-description">
											<h5><?php echo $post->post_excerpt; ?></h5>
											<h3><?php echo $post->post_title; ?></h3>
											<p><?php echo wp_filter_nohtml_kses($post->post_content); ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
 
 
			</div>
			 <?php $content .= ob_get_contents();
			ob_end_clean();
			return $content;
		}

    }
} 
add_action( 'wp_footer', 'ms_testimonial_footer_scripts' );
function ms_testimonial_footer_scripts(){
  ?>
  <script>
	jQuery('.ms_testimonial').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
			} 
		]
	});
   </script>
  <?php
}

 