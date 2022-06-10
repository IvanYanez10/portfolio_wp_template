<?php
/**
 * Single post layout
 *
 * @package subetuwebWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<article id="post-<?php the_ID(); ?>">
	<?php
	// Get posts format.
	$format = get_post_format();

	// Get elements.
	$elements = subetuwebwp_blog_single_elements_positioning();

	// Tags.
	get_template_part( 'partials/single/tags' );

	// Title.
	get_template_part( 'partials/single/header' );

	// Meta.
	get_template_part( 'partials/single/meta' );

	// Featured Image.
	$format = $format ? $format : 'thumbnail';
	get_template_part( 'partials/single/media/blog-single', $format );	

	// Content.
	get_template_part( 'partials/single/content' );

	// Next/Prev.
	ob_start();
	get_template_part( 'partials/single/next-prev' );
	echo ob_get_clean();

	// Related Posts.
	ob_start();
	get_template_part( 'partials/single/related-posts' );
	echo ob_get_clean();

	?>

</article>
