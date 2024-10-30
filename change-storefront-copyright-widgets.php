<?php
/*
 * Plugin Name: Change Copyright for Storefront using Widgets
 * Plugin URI: 
 * Description: Change Storefront copyright text with anything through one or two widgetitzed areas
 * Version: 1.0.3
 * Author: wpcentrics
 * Author URI: https://www.wp-centrics.com
 * Text Domain: change-storefront-copyright-widgets
 * Domain Path: /languages
 * Requires at least: 4.4
 * Tested up to: 5.8
 * WC requires at least: 2.6
 * WC tested up to: 5.5
 * Requires PHP: 5.5
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @package Fish and Ships
*/

defined( 'ABSPATH' ) || exit;

// Prevent double plugin installation
if (defined('WPCENTRICS_SCW_VERSION')  ) {
	
	return;
}

define ('WPCENTRICS_SCW_VERSION',  '1.0.3' );
define ('WPCENTRICS_SCW_PATH',     dirname(__FILE__) . '/' );
define ('WPCENTRICS_SCW_URL',      plugin_dir_url( __FILE__ ) );
	
class wpcentrics_scw {

	private $options = array();

	/**
	 * Constructor.
	 *
	 */
	public function __construct() {
				
		add_action ( 'init', array($this, 'plugin_init') );
		
		add_action ( 'init', array($this, 'plugin_late_init'), 999 );

		add_action ( 'customize_register', array( $this, 'customize_options') );
		
		add_action ( 'storefront_footer',  array($this, 'new_copy_content'), 20 );
		
		add_action ( 'wp_enqueue_scripts', array( $this, 'load_styles') );
	}

	/**
	 * Init
	 *
	 */
	function plugin_init () {
		
		/**
		 * Add the sidebars
		 */
		register_sidebar( array(
			'name'          => __( 'Copyright Content Left/Unique', 'change-storefront-copyright-widgets' ),
			'id'            => 'scc-sidebar-left',
			'description'   => __( 'Storefront Copyright Content - Left sidebar (or fullwidth if right is empty).', 'change-storefront-copyright-widgets' ),
			'before_widget' => '<div id="%1$s" class="scc-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title delta">',
			'after_title'   => '</span>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Copyright Content Right/Secondary', 'change-storefront-copyright-widgets' ),
			'id'            => 'scc-sidebar-right',
			'description'   => __( 'Storefront Copyright Content - Right sidebar (optional, for two columns).', 'change-storefront-copyright-widgets' ),
			'before_widget' => '<div id="%1$s" class="scc-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title delta">',
			'after_title'   => '</span>',
		) );
		
	}
	
	/**
	 * Late Init
	 *
	 */
	function plugin_late_init () {
		
		// Remove the storefront copyright default content
		remove_action( 'storefront_footer', 'storefront_credit', 20 );
	}

	
	/**
	 * Load styles
	 *
	 */
	public function load_styles () {

		wp_register_style( 'wpcentrics_scw_style', WPCENTRICS_SCW_URL . 'assets/css/storefront-copyright-control.css', array(), WPCENTRICS_SCW_VERSION );
		
		wp_enqueue_style  ( 'wpcentrics_scw_style' );
	}

	/**
	 * New widgedted copyright content
	 *
	 */
	function new_copy_content () {
		
		$left_active   = is_active_sidebar('scc-sidebar-left');
		$right_active  = is_active_sidebar('scc-sidebar-right');
		$customizer    = isset($_GET['customize_changeset_uuid']);
		
		if ($customizer || ($left_active && $right_active) ) {
			$rows = 2;
		} elseif ($left_active || $right_active) {
			$rows = 1;
		} else {
			if (!$customizer) return;
		}
		
		$sidebar_left_align  = get_theme_mod( 'scc_sidebar_left_align' );
		$sidebar_right_align = get_theme_mod( 'scc_sidebar_right_align' );
		$menu_style          = get_theme_mod( 'scc_sidebar_menu' );
		
		// Sometimes defaults fails and comes with empty values!
		if ( !in_array( $sidebar_left_align,  array('left', 'right', 'center') ) ) $sidebar_left_align  = 'left';
		if ( !in_array( $sidebar_right_align, array('left', 'right', 'center') ) ) $sidebar_right_align = 'right';
		if ( !in_array( $menu_style,          array('default', 'inline') ) )       $menu_style          = 'inline';
		
		echo '<div class="footer-widgets row-1 col-' . esc_attr($rows) . ' fix scc-sidebar-widgets">';
		
		// Left sidebar
		if ($left_active) {
			
			echo '<div class="block footer-widget-1 scc-sidebar-left scc-sidebar-align-' . esc_attr( $sidebar_left_align ) . ' scc-sidebar-menu-' . esc_attr($menu_style) . '">';
			dynamic_sidebar('scc-sidebar-left');
			if ($customizer) {
				echo '<p><strong class="scc-sidebar-rtl-advice">'  . __('RTL language?', 'change-storefront-copyright-widgets') . '</strong> ' . __('You can change the widget alignment on Customise > Footer options', 'change-storefront-copyright-widgets') . '</p>';
			}
			echo '</div>';

		} else if ($customizer) {
			// Empty, but we are on customizer
			echo '<div class="block footer-widget-1 scc-sidebar-empty scc-sidebar-left scc-sidebar-align-' . esc_attr( $sidebar_left_align ) . ' scc-sidebar-menu-' . esc_attr($menu_style) . '">';
			echo '<h4>' . __('Left/Unique copyright sidebar', 'change-storefront-copyright-widgets') . '</h4>';
			echo '<p>'  . __('Here you can set content through adding widgets: your logo, arbitrary text, menu... whatever.', 'change-storefront-copyright-widgets') . '</p>';
			echo '<p><strong class="scc-sidebar-rtl-advice">'  . __('RTL language?', 'change-storefront-copyright-widgets') . '</strong> ' . __('You can change the widget alignment on Customise > Footer options', 'change-storefront-copyright-widgets') . '</p>';
			dynamic_sidebar('scc-sidebar-left');
			echo '</div>';
		}
		
		// Right sidebar
		if ($right_active) {
			
			echo '<div class="block footer-widget-2 scc-sidebar-right scc-sidebar-align-' . esc_attr( $sidebar_right_align ) . ' scc-sidebar-menu-' . esc_attr($menu_style) . '">';
			dynamic_sidebar('scc-sidebar-right');
			if ($customizer) {
				echo '<p><strong class="scc-sidebar-rtl-advice">'  . __('RTL language?', 'change-storefront-copyright-widgets') . '</strong> ' . __('You can change the widget alignment on Customise > Footer options', 'change-storefront-copyright-widgets') . '</p>';
			}
			echo '</div>';

		} else if ($customizer) {
			// Empty, but we are on customizer
			echo '<div class="block footer-widget-2 scc-sidebar-empty scc-sidebar-right scc-sidebar-align-' . esc_attr( $sidebar_right_align ) . ' scc-sidebar-menu-' . esc_attr($menu_style) . '">';
			echo '<h4>' . __('Right/Secondary copyright sidebar', 'change-storefront-copyright-widgets') . '</h4>';
			echo '<p>'  . __('Here you can set content through adding widgets, or leave empty to make the left/main sidebar fullwidth', 'change-storefront-copyright-widgets') . '</p>';
			echo '<p><strong class="scc-sidebar-rtl-advice">'  . __('RTL language?', 'change-storefront-copyright-widgets') . '</strong> ' . __('You can change the widget alignment on Customise > Footer options', 'change-storefront-copyright-widgets') . '</p>';
			dynamic_sidebar('scc-sidebar-right');
			echo '</div>';
		}
		echo '</div>';
	}
	
	function customize_options ($wp_customize) {

		/* default settings */
		$wp_customize->add_setting( 'scc_sidebar_left_align',  array( 'default' => 'left'  ) );
		$wp_customize->add_setting( 'scc_sidebar_right_align', array( 'default' => 'right' ) );
		$wp_customize->add_setting( 'scc_sidebar_menu',        array( 'default' => 'inline' ) );

		/* Let's add the controls */
		$wp_customize->add_control(
	        new WP_Customize_Control(
	            $wp_customize,
	            'scc_sidebar_left_align',
	            array(
	                'label'       => __( 'Left/unique sidebar align', 'change-storefront-copyright-widgets' ),
	                'section'     => 'storefront_footer',
	                'settings'    => 'scc_sidebar_left_align',
	                'type'		  => 'select',
					'choices'     => array (
										'left'   => __('Left'),
										'center' => __('Center'),
										'right'  => __('Right'),
									),
					'priority'    => 45,
				)
			)
		);

		$wp_customize->add_control(
	        new WP_Customize_Control(
	            $wp_customize,
	            'scc_sidebar_right_align',
	            array(
	                'label'       => __( 'Right/secondary sidebar align', 'change-storefront-copyright-widgets' ),
	                'section'     => 'storefront_footer',
	                'settings'    => 'scc_sidebar_right_align',
	                'type'		  => 'select',
					'choices'     => array (
										'left'   => __('Left'),
										'center' => __('Center'),
										'right'  => __('Right'),
									),
					'priority'    => 45,
				)
			)
		);

		$wp_customize->add_control(
	        new WP_Customize_Control(
	            $wp_customize,
	            'scc_sidebar_menu',
	            array(
	                'label'       => __( 'How the menus should be shown?', 'change-storefront-copyright-widgets' ),
					'description' => __( '(if you use any menu widget)', 'change-storefront-copyright-widgets' ),
	                'section'     => 'storefront_footer',
	                'settings'    => 'scc_sidebar_menu',
	                'type'		  => 'radio',
					'choices'     => array (
										'default' => _x('As list (default)', 'How the menus should be shown', 'change-storefront-copyright-widgets'),
										'inline'  => _x('In one line', 'How the menus should be shown', 'change-storefront-copyright-widgets'),
									),
					'priority'    => 50,
				)
			)
		);

	}

}

$wpcentrics_scw = new wpcentrics_scw();

?>
