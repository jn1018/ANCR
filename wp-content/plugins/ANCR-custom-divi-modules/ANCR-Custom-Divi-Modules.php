<?php
/*
Plugin Name: ANCR Custom Divi Modules
Plugin URI:  https://iccsafe.org
Description: Custom DIVI Module (v 4.0) used to create a frame around images
Version:     1.0.0
Author:      ICCW 2019
Author URI:  https://iccsafe.org
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: anim-ancr-image-module
Domain Path: /languages

ANCR Custom DIVI Modules is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

ANCR Custom DIVI Modules is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with ANCR Custom DIVI Modules. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 'anim_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function anim_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ANCRCustomDiviModules.php';
}
add_action( 'divi_extensions_init', 'anim_initialize_extension' );
endif;
