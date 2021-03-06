<?php
/**
 * Post single header meta style 2
 *
 * @package subetuwebWP WordPress theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or exit;

// Get meta sections.
$sections = subetuweb_blog_single_header_meta();

// Return if sections are empty, not post type or quote post format.
if ( empty( $sections ) || 'post' !== get_post_type() || 'quote' === get_post_format() ) {
	return;
}

// Don't display modified date if the same as the published date.
$subetuweb_date_onoff = false;
$subetuweb_date_onoff = apply_filters( 'subetuweb_single_header_modified_date_state', $subetuweb_date_onoff );
$display_mod_date = ( false === $subetuweb_date_onoff || ( true === $subetuweb_date_onoff && ( get_the_date() != get_the_modified_date() ) ) ) ? true : false;

do_action( 'subetuweb_before_single_post_header_meta' );
?>

<ul class="meta-item meta-style-3 <?php echo subetuweb_blog_single_header_meta_separator_class(); ?>">

	<?php
	// Loop through meta sections.
	foreach ( $sections as $section ) {
		?>

		<?php if ( 'author' === $section ) { ?>
			<li class="meta-author" aria-label="<?php esc_attr( subetuwebwp_theme_strings( 'owp-string-written-by' ) ); ?>"><?php subetuwebwp_icon( 'user' ); ?><?php subetuweb_get_post_author( array( 'prefix' => '', 'aria_prefix' => '' ) ); ?></li>
		<?php } ?>

		<?php if ( 'date' === $section ) { ?>
			<li class="meta-date" aria-label="<?php esc_attr( subetuwebwp_theme_strings( 'owp-string-wai-published-on' ) ); ?>"><?php subetuwebwp_icon( 'date' ); ?><?php subetuweb_get_post_date( array( 'prefix' => '' ) ); ?></li>
		<?php } ?>

		<?php if ( 'mod-date' === $section && true === $display_mod_date ) { ?>
			<li class="meta-mod-date" aria-label="<?php esc_attr( subetuwebwp_theme_strings( 'owp-string-wai-updated-on' ) ); ?>"><?php subetuwebwp_icon( 'm_date' ); ?><?php subetuweb_get_post_modified_date( array( 'prefix' => '' ) ); ?></li>
		<?php } ?>

		<?php if ( 'categories' === $section && has_category() ) { ?>
			<li class="meta-cat" aria-label="<?php esc_attr( subetuwebwp_theme_strings( 'owp-string-posted-in' ) ); ?>"><?php subetuwebwp_icon( 'category' ); ?><?php subetuweb_get_post_categories( array( 'prefix' => '' ) ); ?></li>
		<?php } ?>

		<?php if ( 'tags' === $section && ! empty( subetuweb_get_post_tags( '', false ) ) ) { ?>
			<li class="meta-tag" aria-label="<?php esc_attr( subetuwebwp_theme_strings( 'owp-string-tagged-as' ) ); ?>"><?php subetuwebwp_icon( 'hashtag' ); ?><?php subetuweb_get_post_tags( array( 'prefix' => '' ) ); ?></li>
		<?php } ?>

		<?php if ( 'reading-time' === $section ) { ?>
			<li class="meta-rt" aria-label="<?php esc_attr( subetuwebwp_theme_strings( 'owp-string-wai-reading-time' ) ); ?>"><?php subetuwebwp_icon( 'r_time' ); ?><?php subetuweb_get_post_reading_time(); ?></li>
		<?php } ?>

		<?php if ( 'comments' === $section && comments_open() && ! post_password_required() ) { ?>
			<li class="meta-comments" aria-label="<?php echo esc_attr( subetuwebwp_theme_strings( 'owp-string-wai-comments' ) ); ?>"><?php subetuwebwp_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'subetuwebwp' ), esc_html__( '1 Comment', 'subetuwebwp' ), esc_html__( '% Comments', 'subetuwebwp' ), 'comments-link' ); ?></li>
		<?php } ?>

	<?php } ?>

</ul>

<?php do_action( 'subetuweb_after_single_post_header_meta' ); ?>
