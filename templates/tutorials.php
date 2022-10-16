<?php
/**
 * Template Name: Tutorials
 *
 * @package subetuwebWP WordPress theme
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://ivanyz.com/wp-content/themes/portfolio-theme/assets/css/tutorials-style.css">
</head>

<body>

<?php do_action( 'subetuweb_header' ); ?>

	<h1>Nuevos</h1>
	<p>Explore our structured learning paths to discover everything you need to know about building for the modern web.</p>
	<a href="">Ver todos</a>
	<div class="row">
		<?php 
		$i=0;
		for($i = 1; $i <= 4; $i++) { ?>

		<div class="course col-4">
			<a class="card" data-style="branded" href="https://ivanyz.com/tutorials/some-tutorial/"> 
				<div class="card__header repel"><p class="color-mid-text">Course</p>
					<div class="counter t-bg-core-primary t-color-shades-light-bright">
						<span aria-label="25 recursos" class="counter__content">25</span>
						<svg viewBox="0 0 24 24" aria-label="mortarboard" class="icon" fill="currentColor" height="24" role="img" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M12.51 3.47a1.29 1.29 0 0 0-1 0L3 7a1.33 1.33 0 0 0 0 2.44L11.49 13a1.38 1.38 0 0 0 1 0L21 9.44A1.33 1.33 0 0 0 21 7Z"></path><path d="M4.71 14.07a1.33 1.33 0 0 1 1.82-1.24l5 2a1.35 1.35 0 0 0 1 0l5-2a1.33 1.33 0 0 1 1.82 1.24v3.1a1.32 1.32 0 0 1-.88 1.25l-6 2.13a1.24 1.24 0 0 1-.89 0l-6-2.13a1.32 1.32 0 0 1-.88-1.25Z"></path></svg>
					</div>
				</div> 
				<img alt="" src="https://web.dev/images/courses/pwa/card.svg" height="150" width="150"> 
				<div class="card__content flow"><p class="text-size-0">A course that breaks down every aspect of modern progressive web app development.</p></div> 
			</a>
		</div>

		<?php } ?>
	</div>

	<h2>Categorias</h2>

	<div class="row banners">

		<div class="col-4 bann">
			Flutter banner
		</div>

		<div class="col">

			<div class="row">
				Cloud banner				
			</div>

			<div class="row">
				Sistemas operativos banner
			</div>
			
		</div>

	</div>

<?php	get_footer(); ?>