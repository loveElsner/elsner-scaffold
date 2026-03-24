<?php
/**
 * Flexible content layout: FAQ Accordion.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$eyebrow = get_sub_field( 'eyebrow' );
$heading = get_sub_field( 'heading' );
$items   = get_sub_field( 'items' );

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class = elsner_scaffold_section_classes( $settings, 'es-faq' );
$section_style = elsner_scaffold_section_style( $settings );

if ( ! $items ) {
	return;
}

// JSON-LD FAQ schema.
$faq_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array(),
);

foreach ( $items as $item ) {
	$faq_schema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => wp_strip_all_tags( $item['question'] ),
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => wp_strip_all_tags( $item['answer'] ),
		),
	);
}
?>

<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">
		<div class="es-faq__inner">

			<div class="es-faq__header">
				<?php if ( $eyebrow ) : ?>
					<span class="es-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
			</div>

			<div class="es-faq__list" role="list">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php
					$item_id = 'faq-item-' . ( $index + 1 );
					$answer_id = 'faq-answer-' . ( $index + 1 );
					?>
					<div class="es-faq__item js-faq-item" role="listitem">
						<button class="es-faq__question"
								id="<?php echo esc_attr( $item_id ); ?>"
								aria-expanded="false"
								aria-controls="<?php echo esc_attr( $answer_id ); ?>">
							<span><?php echo esc_html( $item['question'] ); ?></span>
							<span class="es-faq__icon" aria-hidden="true">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M6 9l6 6 6-6"/>
								</svg>
							</span>
						</button>
						<div class="es-faq__answer wysiwyg-content"
							 id="<?php echo esc_attr( $answer_id ); ?>"
							 role="region"
							 aria-labelledby="<?php echo esc_attr( $item_id ); ?>"
							 hidden>
							<?php echo wp_kses_post( $item['answer'] ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>
