<?php
/**
 * Template part: footer social links.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$networks = array(
	'facebook'  => array( 'label' => 'Facebook', 'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>' ),
	'twitter'   => array( 'label' => 'Twitter / X', 'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 4l16 16M4 20 20 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>' ),
	'instagram' => array( 'label' => 'Instagram', 'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>' ),
	'linkedin'  => array( 'label' => 'LinkedIn', 'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>' ),
	'youtube'   => array( 'label' => 'YouTube', 'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>' ),
);

$has_links = false;
foreach ( array_keys( $networks ) as $network ) {
	if ( get_field( 'social_' . $network, 'option' ) ) {
		$has_links = true;
		break;
	}
}

if ( ! $has_links ) {
	return;
}
?>
<div class="social-links" aria-label="<?php esc_attr_e( 'Social Media Links', 'elsner-scaffold' ); ?>">
	<?php foreach ( $networks as $network => $data ) : ?>
		<?php $url = get_field( 'social_' . $network, 'option' ); ?>
		<?php if ( $url ) : ?>
			<a class="social-links__item social-links__item--<?php echo esc_attr( $network ); ?>"
			   href="<?php echo esc_url( $url ); ?>"
			   target="_blank"
			   rel="noopener noreferrer"
			   aria-label="<?php echo esc_attr( $data['label'] ); ?>">
				<?php echo $data['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
