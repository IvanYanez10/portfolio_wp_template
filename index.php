<?php
/**
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package subetuwebWP WordPress theme
 * 
 */

  get_header(); 

  wp_body_open();
  
  do_action( 'subetuwebwp_blog_page' );

  get_footer(); 

?>