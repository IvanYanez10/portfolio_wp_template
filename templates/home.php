<?php
/**
 * Template Name: home
 *
 * @package subetuwebWP WordPress theme
 */

?>
<!-- html -->
<?php get_header(); ?>

<!-- page data -->
<?php 

  wp_body_open(); 

  do_action( 'subetuwebwp_body_content' );

  //the_content(); get the content from wp page
?>

<!-- footer -->
<?php get_footer(); ?>

</body>
</html>
