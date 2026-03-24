<?php
/**
 * Custom nav walker.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Custom Walker_Nav_Menu with Bootstrap-style markup and ARIA support.
 */
class Elsner_Scaffold_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @param string    $output Used to append additional content. Passed by reference.
	 * @param \WP_Post  $item   Menu item data object.
	 * @param int       $depth  Depth of menu item. Used for padding.
	 * @param \stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int       $id     Current item/context ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent      = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes, true );

		$classes[] = 'nav__item';
		if ( $has_children ) {
			$classes[] = 'nav__item--has-children';
		}
		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$classes[] = 'nav__item--active';
		}

		$class_names = implode( ' ', array_filter( apply_filters( 'nav_menu_css_class', $classes, $item, $args, $depth ) ) );
		$id_attr     = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );

		$output .= $indent . '<li id="' . esc_attr( $id_attr ) . '" class="' . esc_attr( $class_names ) . '">';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';
		$atts['class']  = 'nav__link';

		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$atts['aria-current'] = 'page';
		}

		if ( $has_children ) {
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
		}

		if ( '_blank' === $atts['target'] ) {
			$atts['rel'] = 'noopener noreferrer';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = isset( $args->before ) ? $args->before : '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );

		// Add dropdown toggle icon for parent items.
		if ( $has_children ) {
			$item_output .= '<span class="nav__dropdown-arrow" aria-hidden="true"></span>';
		}

		$item_output .= '</a>';
		$item_output .= isset( $args->after ) ? $args->after : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string    $output Used to append additional content. Passed by reference.
	 * @param int       $depth  Depth of menu item. Used for padding.
	 * @param \stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"nav__dropdown\" role=\"list\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string    $output Used to append additional content. Passed by reference.
	 * @param int       $depth  Depth of menu item. Used for padding.
	 * @param \stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}
}
