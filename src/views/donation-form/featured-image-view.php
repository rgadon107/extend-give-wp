<?php
/*
 * The donation form featured image view file.
 */
?>
<figure id="donation-form-featured-image" class="donate-page-featured-image attachment-<?php echo esc_attr( $attachment_id ); ?>" aria-describedby="donation-form-featured-image">
	<?php echo wp_get_attachment_image( $attachment_id, $size, $icon = false, $attr = [ 'class' => 'featured-image' ] ); ?>
	<figcaption id="donation-form-image-caption" class="featured-image-caption"><em><?php echo esc_attr( $post_excerpt ); ?></em></figcaption>
</figure>
