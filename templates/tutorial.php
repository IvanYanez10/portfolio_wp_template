<?php
/**
 * Template Name: Tutorial base
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
	<link rel="stylesheet" href="http://localhost/wp-testing/wp-content/themes/portfolio-theme/assets/css/tutorial-style.css">
</head>

<body>

<nav id="site-navigation" class="<?php echo esc_attr( $inner_classes ); ?> d-flex flex-wrap justify-content-end py-3 mb-4 navbar-expand-lg">

  <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
		<i class="fa-solid fa-bars"></i>
	</button>

		<div class="collapse navbar-collapse" id="navbarCollapse">
				<div class="navbar-nav ms-auto nav nav-pills">
					<a href="#"><span>Tutoriales</span></a>
          <a href="#"><span>GitHub</span></a>
          <a href="#"><span>youtube</span></a>
          <a href="#"><span>Blog</span></a>
					<a href="#" class="contact-btn" aria-current="page" onMouseOver="this.style.color='white'"><span>Contact me</span></a>	
			</div>
	</div>

</nav>

<div class="row">

  <div class="col-2 first">
    <img src="" alt="reference" height="150" width="200">
    <ul class="index">
      <a href="#"><li style="font-weight:bold;color:white;">Introduccion
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="10" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="id1"><path fill="#ffffff"  d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 " clip-rule="nonzero"/></clipPath></defs><g clip-path="url(#id1)"><path fill="rgb(255,255,255)" d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 " fill-opacity="1" fill-rule="nonzero"/></g></svg>
      </li></a>
      <?php 
        $i=0;
        for($i = 1; $i <= 20; $i++) { ?>
          <a href="#"><li>00<?= $i ?> Elemento <?= $i ?> </li></a>
        <?php } ?>
    </ul>
  </div>

  <div class="col content">
    <span>Flutter > Basico</span>
    <h1>Introduccion</h1>
    <?php include 'content/tutorial-content.php';
    echo $tut_content;
    ?>    
  </div>

  <div class="col-2 cont">
    <p>En esta pagina</p>
    <ul>        
      <li><a href="">Contenido y tamaño</a></li>
      <li><a href="" style="font-weight:bold;color:white;">Las áreas del modelo de caja</a></li>
      <li><a href="">Una analogía útil</a></li>
      <li><a href="">Depurando el modelo de caja</a></li>
      <li><a href="">Controlando el modelo de caja</a></li>
      <li><a href="">Recursos</a></li>
      <li><a href="">Hojas de estilo del agente de usuario</a></li>
    </ul>
  </div>
</div>

<?php	get_footer(); ?>