<?php

require_once 'Sizing.php';

/**
 * Class ET_Builder_Module_Helper_Slider
 */
class CustomImageFrameSlider{

	/**
	 * Returns slider arrows CSS selector
	 *
	 * @since 3.25.3
	 *
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function get_arrows_selector($prefix = '%%order_class%%') {
		return implode( ',', array(
			"$prefix .et-pb-slider-arrows .et-pb-arrow-prev",
			"$prefix .et-pb-slider-arrows .et-pb-arrow-next",
		) );
	}

	/**
	 * Returns slider dots CSS selector
	 *
	 * @since 3.25.3
	 *
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function get_dots_selector($prefix = '%%order_class%%') {
		return "$prefix .et-pb-controllers a";
	}
}

function custom_slider_options() {
	return new CustomImageFrameSlider();
}
