<?php
/**
 * Footer layout
 *
 * @package subetuwebWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<footer id="footer" class="<?php echo esc_attr( subetuwebwp_footer_classes() ); ?>"<?php subetuwebwp_schema_markup( 'footer' ); ?> role="contentinfo">

	<div id="copyright" class="clr text-center text-muted" role="contentinfo">
		<?php echo "< / > made with ♥ by me";?>
	</div>

</footer>
<!-- end-footer -->
