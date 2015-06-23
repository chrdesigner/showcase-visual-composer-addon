<?php

add_action( 'vc_before_init', 'showcase_vc_addon_function' );

// Generate param type "number"
if ( function_exists('add_shortcode_param'))
{
	add_shortcode_param( 'number', 'sc_number_field' );
}

// Function generate param type "number"
function sc_number_field($settings, $value)
{
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$min = isset($settings['min']) ? $settings['min'] : '';
	$max = isset($settings['max']) ? $settings['max'] : '';
	$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$output .= '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
	return $output;
}

// Generate param type "range"
if ( function_exists('add_shortcode_param'))
{
	add_shortcode_param( 'range', 'sc_range_field' );
}

// Function generate param type "range"
function sc_range_field($settings, $value)
{
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$min = isset($settings['min']) ? $settings['min'] : '';
	$max = isset($settings['max']) ? $settings['max'] : '';
	$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$output .= '<input type="range" id="sc_range_field" step="1" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" oninput="outputUpdate(value)"><output for="sc_range_field" id="sc_range_result">'.$value.'</output>'.$suffix;
	return $output;
}

// Generate param type "sc_title_separator"
if ( function_exists('add_shortcode_param'))
{
	add_shortcode_param( 'sc_title_separator', 'sc_title_separator_field' );
}

function sc_title_separator_field( $settings, $value ) {
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$output .= '<h4 class="wpb-textinput wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '">'. $value .'</h4>';
	return $output;
}

// Generate param type "custom_size"
if ( function_exists('add_shortcode_param'))
{
	add_shortcode_param( 'custom_size', 'sc_custom_size' );
}

function sc_custom_size( $settings, $value ) {
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$added_sizes = get_intermediate_image_sizes();
	$output .= '<select id="thumb" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'">';
		foreach($added_sizes as $key => $sc_value){
			if($value == $sc_value){
				$selected = "selected='selected'";
			} else {
				$selected = '';
			}
			$output .= '<option '.$selected.' value="'. $sc_value .'">'. $sc_value .'</option>';
		}
	$output .= '</select>' ;
	return $output;
}


function showcase_vc_addon_function() {

	vc_map( array(
        'name' => __('Showcases', 'showcase-vc-addon'),
        'base' => 'sc_showcase_box',
        'admin_enqueue_js' => array( plugins_url( 'assets/js/script.admin.showcase.js', dirname(__FILE__) ) ),
        'admin_enqueue_css' => array( plugins_url( 'assets/css/style.admin.showcase.css', dirname(__FILE__) ) ),
		"description" => __("Shortcode for Showcase", 'showcase-vc-addon'),
		"icon" => "icon-sc-vc-addon",
        'params'=>array(
        	array(
				"type" => "sc_title_separator",
				"param_name" => "info_title_separator",
				"value" => __( "Configure Title Style", "showcase-vc-addon" ),
				'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
        	array(
				"type" => "colorpicker",
				"heading" => __( "Title color", "showcase-vc-addon" ),
				"param_name" => "showcase_color_title",
				"value" => '#333333',
				'group' => __( 'General Settings', 'showcase-vc-addon' ),
				"description" => __( "Color Default is #333333", "showcase-vc-addon" ),
				"description" => __( "Choose title color", "showcase-vc-addon" )
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => __("Font Size Title", "showcase-vc-addon"),
				"param_name" => "showcase_size_title",
				"min" => 12,
				"suffix" => "px",
				"value" => '30',
				"dependency" => array(
					"element" => "content",
					"not_empty" => true
				),
				"description" => __( "Default is 30px", "showcase-vc-addon" ),
				'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Text Align - Title', 'showcase-vc-addon' ),
					'param_name' => 'showcase_size_align_title',
					"value"      => array(
						__('Left', 'showcase-vc-addon')  	=> 'left',
						__('Center', 'showcase-vc-addon')   => 'center',
						__('Right', 'showcase-vc-addon')    => 'right',
				    ),
				    "description" => __( "Default is Left", "showcase-vc-addon" ),
				    'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
				"type" => "sc_title_separator",
				"param_name" => "box_title_separator",
				"value" => __( "Configure Content Box Style", "showcase-vc-addon" ),
				'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Border Color", "showcase-vc-addon" ),
				"param_name" => "showcase_border_color",
				"value" => '#F4F4F4',
				'group' => __( 'General Settings', 'showcase-vc-addon' ),
				"description" => __( "Choose Border Color<br /><small>Color Default is #F4F4F4</small>", "showcase-vc-addon" )
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => __("Border Width", "showcase-vc-addon"),
				"param_name" => "showcase_border_width",
				"min" => 0,
				"max" => 15,
				"suffix" => "px",
				"value" => '6',
				"dependency" => Array("element" => "content", "not_empty" => true),
				"description" => __( "Default is 6px", "showcase-vc-addon" ),
				'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => __("Border Radius", "showcase-vc-addon"),
				"param_name" => "showcase_border_radius",
				"min" => 0,
				"max" => 15,
				"suffix" => "px",
				"value" => '0',
				"dependency" => Array("element" => "content", "not_empty" => true),
				"description" => __( "Default is 0px", "showcase-vc-addon" ),
				'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Border Style', 'showcase-vc-addon' ),
				'param_name' => 'showcase_border_style',
				"value"       => array(
					__('Solid', 'showcase-vc-addon')  	=> 'solid',
					__('Dotted', 'showcase-vc-addon')   => 'dotted',
					__('Dashed', 'showcase-vc-addon')    => 'dashed',
					__('Double', 'showcase-vc-addon')  	=> 'double',
					__('None', 'showcase-vc-addon')  	=> 'none',
			    ),
			    "description" => __( "Default is Solid", "showcase-vc-addon" ),
			    'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
				"type" => "colorpicker",
				"heading" => __( "Background Color", "showcase-vc-addon" ),
				"param_name" => "showcase_bg_color",
				"value" => '#FCFCFC',
				'group' => __( 'General Settings', 'showcase-vc-addon' ),
				"description" => __( "Choose Background Color<br /><small>Color Default is #FCFCFC</small>", "showcase-vc-addon" )
			),
			array(
				"type" => "sc_title_separator",
				"param_name" => "info_title_separator",
				"value" => __( "Configure Pagination Style", "showcase-vc-addon" ),
				'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Show Pagination', 'showcase-vc-addon' ),
					"admin_label" => true,
					'param_name' => 'sc_pagination',
					"value"       => array(
						__('False', 'showcase-vc-addon')  => 'false',
				        __('True', 'showcase-vc-addon')  => 'true'
				    ),
				    'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Show Title Next/Previous Showcase', 'showcase-vc-addon' ),
					'param_name' => 'sc_title_next_prev',
					"value"       => array(
						__('False', 'showcase-vc-addon')  => 'false',
				        __('True', 'showcase-vc-addon')  => 'true'
				    ),
				    'group' => __( 'General Settings', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Show Featured Thumbnail Next/Previous', 'showcase-vc-addon' ),
					'param_name' => 'sc_thumb_next_prev',
					"value"       => array(
						__('False', 'showcase-vc-addon')  => 'false',
				        __('True', 'showcase-vc-addon')  => 'true'
				    ),
				    'group' => __( 'General Settings', 'showcase-vc-addon' ),
				    "description" => "<br/>"
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'lazyLoad', 'showcase-vc-addon' ),
					"admin_label" => true,
					'param_name' => 'sc_lazyload',
					"value"       => array(
						__('False', 'showcase-vc-addon')  => 'false',
				        __('True', 'showcase-vc-addon')  => 'true'
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
				    'description' => __( 'Add lazyLoad in the Carousel Thumbnail', 'showcase-vc-addon')
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Loop Infinite', 'showcase-vc-addon' ),
					"admin_label" => true,
					'param_name' => 'sc_loop_infinite',
					"value"       => array(
						__('False', 'showcase-vc-addon')  => 'false',
				        __('True', 'showcase-vc-addon')  => 'true'
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Order Showcase', 'showcase-vc-addon' ),
					'param_name' => 'sc_order',
					"value"       => array(
						__('DESC', 'showcase-vc-addon')  => 'DESC',
				        __('ASC', 'showcase-vc-addon')  => 'ASC',
				        __('RAND', 'showcase-vc-addon') => 'rand'
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Show Content', 'showcase-vc-addon' ),
					'param_name' => 'show_content',
					"admin_label" => true,
					"value"       => array(
						__('Below', 'showcase-vc-addon')  => 'vc_below',
				        __('Above', 'showcase-vc-addon')  => 'vc_above',
				        __('Floats', 'showcase-vc-addon') => 'vc_floats'
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
					'description' => __( 'Presentation of Content', 'showcase-vc-addon')
			),
			array(
				"type" => "range",
				"class" => "",
				"heading" => __("Margin", "showcase-vc-addon"),
				"param_name" => "showcase_range",
				"min" => 0,
				"max" => 40,
				"suffix" => "%",
				"value" => '10',
				"dependency" => Array("element" => "content", "not_empty" => true),
				"description" => __( "Default is 10px", "showcase-vc-addon" ),
				'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'List per', 'showcase-vc-addon' ),
					'param_name' => 'post_count',
					"value"       => array(
				        __('4 per line', 'showcase-vc-addon')  => '4',
				        __('6 per line', 'showcase-vc-addon')  => '6',
				        __('8 per line', 'showcase-vc-addon')  => '8',
				        __('10 per line', 'showcase-vc-addon') => '10'
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
					'description' => __( 'How many Showcases per scroll', 'showcase-vc-addon')
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Responsive', 'showcase-vc-addon' ),
					'param_name' => 'showcase_responsive',
					"value"       => array(
						 __('Yes', 'showcase-vc-addon') => 'true',
						 __('No', 'showcase-vc-addon') => 'false',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'stopOnHover', 'showcase-vc-addon' ),
					'param_name' => 'stop_hover',
					"value"       => array(
				        __('Deactivated', 'showcase-vc-addon')  => 'false',
				        __('Activated', 'showcase-vc-addon')    => 'true',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
					'description' => __( 'Stop autoplay on mouse hover', 'showcase-vc-addon')
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'autoPlay', 'showcase-vc-addon' ),
					'param_name' => 'auto_play',
					"value"       => array(
						__('Activated', 'showcase-vc-addon')    => 'true',
				        __('Deactivated', 'showcase-vc-addon')  => 'false',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'autoPlay Timeout', 'showcase-vc-addon' ),
					'param_name' => 'auto_play_timeout',
					"value"       => array(
				        __('3 Seconds', 'showcase-vc-addon')  => '3000',
				        __('6 Seconds', 'showcase-vc-addon')  => '6000',
				        __('8 Seconds', 'showcase-vc-addon')  => '8000',
				        __('14 Seconds', 'showcase-vc-addon') => '14000',
				        __('28 Seconds', 'showcase-vc-addon') => '28000',
				        __('56 Seconds', 'showcase-vc-addon') => '56000',
				        __('Stoped', 'showcase-vc-addon')	 => 'false',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination Speed', 'showcase-vc-addon' ),
					'param_name' => 'pagination_speed',
					"value"       => array(
						__('4 Milliseconds', 'showcase-vc-addon')  => '400',
				        __('8 Milliseconds', 'showcase-vc-addon')  => '800',
				        __('16 Milliseconds', 'showcase-vc-addon')  => '1600',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' )
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination', 'showcase-vc-addon' ),
					'param_name' => 'pagination',
					"value"       => array(
						__('Activated', 'showcase-vc-addon')    => 'true',
				        __('Deactivated', 'showcase-vc-addon')  => 'false',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
					'description' => __( 'Show pagination', 'showcase-vc-addon')
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Navigation', 'showcase-vc-addon' ),
					'param_name' => 'navigation',
					"value"       => array(
				        __('Deactivated', 'showcase-vc-addon')  => 'false',
				        __('Activated', 'showcase-vc-addon')    => 'true',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
					'description' => __( 'Display "Next" and "Previous" buttons.', 'showcase-vc-addon')
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Show dots each x item', 'showcase-vc-addon' ),
					'param_name' => 'pagination_numbers',
					"value"       => array(
						__('Deactivated', 'showcase-vc-addon')  => 'false',
						__('Activated', 'showcase-vc-addon')    => 'true',
				    ),
				    'group' => __( 'Carousel options', 'showcase-vc-addon' ),
					'description' => '<br />'
			),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Image Thumbnail', 'showcase-vc-addon' ),
					'param_name' => 'image_thumbnail',
					"admin_label" => true,
					"value"       => array(
				        __('Circle', 'showcase-vc-addon')  => 'showcase-circle',
				        __('Square', 'showcase-vc-addon')  => 'showcase-square',
				    ),
				    'group' => __( 'Image Configuration', 'showcase-vc-addon' ),
					'description' => __( 'Select the presentation thumbnail format', 'showcase-vc-addon')
			),
			array(
					'type' 		 => 'custom_size',
					'heading' 	 => __( 'Image Size Thumb', 'showcase-vc-addon' ),
					'param_name' => 'showcase_thumb',
					"admin_label" => true,
					"value" => "",
					'group' => __( 'Image Configuration', 'showcase-vc-addon' ),
					'description' => __( 'Add your custom <strong>image_size()</strong> if you want.', 'showcase-vc-addon')
			),
			array(
					'type' 		 => 'textfield',
					'heading' 	 => __( 'Add Custom Class', 'showcase-vc-addon' ),
					'param_name' => 'base_class',
					"value"       => '',
					'group' => __( 'Image Configuration', 'showcase-vc-addon' ),
					'description' => __( "Add your custom <strong>Class</strong> if you want.", 'showcase-vc-addon')
			),
		),
		'category' => __( 'CHR Designer - Shortcodes', 'showcase-vc-addon' ),     
    ) );

}