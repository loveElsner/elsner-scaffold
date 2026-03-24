/**
 * Customizer live preview bindings.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

( function ( $ ) {
	// Site title.
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-title a' ).text( newval );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-description' ).text( newval );
		} );
	} );

	// Header text colour.
	wp.customize( 'header_textcolor', function ( value ) {
		value.bind( function ( newval ) {
			if ( 'blank' === newval ) {
				$( '.site-title a, .site-description' ).css( { clip: 'rect(1px, 1px, 1px, 1px)', position: 'absolute' } );
			} else {
				$( '.site-title a, .site-description' ).css( { clip: 'auto', position: 'relative', color: newval } );
			}
		} );
	} );

	// Footer copyright.
	wp.customize( 'elsner_scaffold_footer_copyright', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-footer__copyright' ).html( newval );
		} );
	} );

	// Brand colour — primary.
	wp.customize( 'elsner_scaffold_color_primary', function ( value ) {
		value.bind( function ( newval ) {
			document.documentElement.style.setProperty( '--color-primary', newval );
		} );
	} );

	// Brand colour — secondary.
	wp.customize( 'elsner_scaffold_color_secondary', function ( value ) {
		value.bind( function ( newval ) {
			document.documentElement.style.setProperty( '--color-secondary', newval );
		} );
	} );

	// Brand colour — accent.
	wp.customize( 'elsner_scaffold_color_accent', function ( value ) {
		value.bind( function ( newval ) {
			document.documentElement.style.setProperty( '--color-accent', newval );
		} );
	} );
} )( jQuery );
