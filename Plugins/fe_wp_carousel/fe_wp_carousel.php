<?php
/*  
Plugin Name: FLoral Exhibits Carousel
Plugin URI: http://www.aaronmadethis.com 
Description: Plugin for custom post type — Floral Exhibits Carousel Items
Author: Aaron Pedersen 
Version: 0.1
Author URI: http://www.aaronmadethis.com/

Copyright 2013  Aaron Pedersen  (email : info@aaronmadethis.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

define('FE_WP_CAROUSEL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define('FE_WP_CAROUSEL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('FE_WP_CAROUSEL_SETTINGS_PAGE', 'fe_wp_carousel');
define('FE_WP_CAROUSEL_ADMIN', strtolower(site_url('/').'wp-admin/options-general.php?page='.FE_WP_CAROUSEL_SETTINGS_PAGE));

/* Load our main functions file */
require ( FE_WP_CAROUSEL_PLUGIN_PATH . 'inc/functions.php'); 


?>