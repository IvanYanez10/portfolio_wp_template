<?php $image= "https://ivanyz.com/wp-content/uploads/2022/10/background.png"; ?>  

<img class="floating" src="<?= $image ?>">

<div class="row principal" id="home">

  <div class="col-12 col-lg-4 col-sm-7">
    <h1 class="row name-brand">
      I'm<br>
      <small class="">Ivan Yañez</small>
    </h1>

    <div class="row description">
      <div class="col-4"><hr class="first"></div>      
      <div class="col-8 animated">
        <span is="type-async" id="type-text"></span>
        <span class="blinking-cursor">_</span>
      </div>
    </div>

    <div class="row">
      <p class="short">A frelancer who provides
      services for digital
      programming and
      design content needs, 
      for all bussines.</p>
    </div>

  </div>

  <div class="col-12 col-lg-5 col-sm-5 d-flex align-items-center ">    
    <img class="align-self-center bio-image" src="https://ivanyz.com/wp-content/uploads/2022/10/me-01.png" width=350 alt="pic">      
  </div>

  <div class="col-12 col-lg-3 services-col">

    <div class="row card mb-3 first-item">
      <div class="row g-0">
        <div class="col">
          <div class="card-body">
            <h5 class="card-title">Servicio</h5>
            <p class="card-text">Desarrollo de aplicaciones web</p>
            <a href="#" class="services-a">Ver más <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row card second-item">
      <ul class="list-group-horizontal">
        <li class="col-lg-1 list-group-item"><a href="https://www.artstation.com/ivanyz"><i class="fa-brands fa-artstation"></i></a></li>
        <li class="col-lg-1-lg-1 list-group-item"><a href="https://dribbble.com/Ivancr"><i class="fa-brands fa-dribbble"></i></a></li>        
        <li class="col-lg-1 list-group-item"><a href="https://github.com/IvanYanez10"><i class="fa-brands fa-github"></i></a></li>
        <li class="col-lg-1 list-group-item"><a href="https://www.linkedin.com/in/iyanez717/"><i class="fa-brands fa-linkedin-in"></i></a></li>        
        <li class="col-lg-1 list-group-item"><a href="https://www.figma.com/@ivanyz"><i class="fa-brands fa-figma"></i></a></li>
        <li class="col-lg-1 list-group-item"><a href="mailto:ivay@subetuweb.site"><i class="fa-solid fa-envelope"></i></a></li>
      </ul>
    </div>

  </div>

</div>

<!-- services and blog -->
<div class="row mx-5 services" id="services">
    <div class="col-lg-8 px-2 serv">      
      <div class="row mx-2 service">
        <?php 
        include 'services.php';
        $services_array=array_slice($services_array, 0, 6);
        foreach ( $services_array as $service ) :?>
          <div class="col">
            <div class="card text-white card-has-bg" style="background-image:url('https://source.unsplash.com/600x900/?tech');">
              <div class="card-img-overlay d-flex flex-column">
                <div class="card-body">
                  <small class="card-meta mb-2"><?= $service['tag'] ?></small>
                  <h4 class="card-title mt-0 "><?= $service['service'] ?></h4>
                  <small hidden><?= substr($service['description'], 0, 50) ?></small>
                </div>
                <div class="card-footer">
                  <a href="<?php $service['serviceUrl'] ?>" class="services-a">Ver más <i class="fa-solid fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        <?php
        endforeach; 
        ?>
      </div>      
    </div>

    <div class="col-lg-4 px-5 blog-post" >      
      <?php
      $lastposts = get_posts( array(
          'posts_per_page' => 5
      ) );
      if ( $lastposts ) {
        foreach ( $lastposts as $post ) :
          setup_postdata( $post ); ?>

          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-sm-3 col-lg-3 align-self-center">                  
                <?php echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(), $size = 'post-thumbnail').'" class="img-fluid rounded-start" alt="...">'; ?>
              </div>
              <div class="col">
                <div class="card-body">
                  <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  <p class="card-text"><?php the_excerpt();?></p>
                  <p class="card-text"><small class="text-muted"><?php the_date( 'Y-m' ); ?></small></p>
                </div>
              </div>
              <div class="col-1 align-self-center">
                <a href="<?php the_permalink(); ?>"><i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <hr>

            
        <?php
        endforeach; 
        wp_reset_postdata();
      }
      ?>
    </div>
</div>

<!-- floating image -->
<img class="floating" src="<?= $image ?>">

<!-- portfolio -->
<div class="container" id="portfolio">    
    <h1>Portafolio</h1>
    <div class="">
      <?php 
        include 'portfolio.php';
        $top_project=$portfolio_array[0];
      ?>
      <article class="postcard dark blue">
        <a class="postcard__img_link" href="#">
          <img class="postcard__img" src=<?= $top_project['imageUrl'][0] ?> alt="Image Title" />
        </a>
        <div class="postcard__text">
          <h1 class="postcard__title blue"><a href="#"><?= $top_project['portfolio'] ?></a></h1>
          <div class="postcard__subtitle small">
            <p><i class="fas fa-calendar-alt mr-2"></i>  <?= $top_project['who'] ?></p>
          </div>
          <div class="postcard__bar"></div>
          <div class="postcard__preview-txt"><?= substr($top_project['description'], 0, 300) ?></div>
          <ul class="postcard__tagbox">
            <li class="tag__item"><i class="fas fa-tag mr-2"></i> <?= $top_project['tag'] ?></li>
            <li class="tag__item"><i class="fas fa-clock mr-2"></i>  <?= $top_project['readingTime'] ?> min</li>
            <li class="tag__item play blue">
              <a href="#"><i class="fas fa-play mr-2"></i></a>
            </li>
          </ul>
        </div>
      </article>      
    </div>

    <div class="row justify-content-around" style="margin-top:50px;">
      <?php 
      $colors=array('blue', 'red', 'green', 'yellow');
      include 'portfolio.php';
      $portfolio_array=array_slice($portfolio_array, 1, 3);
      foreach ( $portfolio_array as $portfolio_item ) : $col_ind = rand(0, count($colors)-1);?>      
        <article class="col-sm-5 col-md-5 col-lg-3  postcard dark postcard-item <?= $colors[$col_ind] ?>" >
          <a class="postcard__img_link" href="#">
            <img class="postcard__img" src=<?= $top_project['imageUrl'][0] ?>  alt="Image Title" />
          </a>
          <div class="postcard__text">
            <h1 class="postcard__title blue"><a href="#"><?= $portfolio_item['portfolio'] ?></a></h1>
            <div class="postcard__subtitle small">
              <p><i class="fa-solid fa-circle-notch"></i> <?= $portfolio_item['who'] ?> </p>
            </div>
            <div class="postcard__bar"></div>
            <div class="postcard__preview-txt"><?= substr($portfolio_item['description'], 0, 70) ?></div>
            <ul class="postcard__tagbox">
              <li class="tag__item"><i class="fas fa-tag mr-2"></i> <?= $portfolio_item['tag'] ?></li>
              <li class="tag__item"><i class="fas fa-clock mr-2"></i>  <?= $top_project['readingTime'] ?> min</li>
              <li class="tag__item play blue">
                <a href="#"><i class="fas fa-play mr-2"></i></a>
              </li>
            </ul>
          </div>
        </article>  
      <?php
      endforeach; 
      ?>
    </div>
</div>

<!-- about -->
<div class="container" id="about" hidden>
  <article class="about dark blue">
    <div class="about__text">
      <h1 class="about__title blue">Resumen</h1>
      <div class="about__bar"></div>
      <div class="about__preview-txt"><p>Lorem Ipsum is simply dummy text of the printing and typesetting 
        industry. Lorem Ipsum has been the industry's standard dummy text
        ever since the 1500s, when an unknown printer took a galley of type
        and scrambled it to make a type specimen book. It has survived not 
        only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s 
        with the release of Letraset sheets containing Lorem Ipsum passages, 
        and more recently with desktop publishing software like Aldus 
        PageMaker including versions of Lorem Ipsum.</p>
      </div>
    </div>
  </article>      
</div>

<script>
  const data = 
  [
    'desarrollador', 
    'fullstack', 
    'android', 
    'modelado 3d', 
    'videojuegos', 
    'robotica', 
    'ios',
    'automatización', 
    'ciberseguridad', 
    'realidad aumentada', 
    'realidad virtual', 
    'UI/UX'
  ];
  async function init () {
    var i=0;
    const node = document.querySelector("#type-text");  
    await sleep(700);    
    while (true) {      
      await node.type(data[i]);
      await sleep(1000);
      await node.delete(data[i]);
      if(i<data.length-1){              
        i++;        
      }else{
        i=0;
      }            
    }
  }
  const sleep = time => new Promise(resolve => setTimeout(resolve, time));
  class TypeAsync extends HTMLSpanElement {
    get typeInterval () {
      const randomMs = 100 * Math.random();
      return randomMs < 50 ? 10 : randomMs;
    }    
    async type (text) {
      for (let character of text) {
        this.innerText += character;
        await sleep(this.typeInterval);
      }
    }    
    async delete (text) {
      for (let character of text) {
        this.innerText = this.innerText.slice(0, this.innerText.length -1);
        await sleep(this.typeInterval);
      }
    }
  }
  customElements.define('type-async', TypeAsync, { extends: 'span' });
  init();
</script>