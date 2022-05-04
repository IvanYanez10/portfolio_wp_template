<!-- user can change route by customizer -->
<?php $image_attributes = wp_get_attachment_image_src( $attachment_id = 679 );
  if ( $image_attributes ) : 
    $image= $image_attributes[0];
  endif;
?> 

<!-- floating image -->
<img class="floating" src="<?= $image ?>">

<!--  -->
<div class="row principal" id="home" style="height:600px; ">

  <div class="col-3 text-left">
    <h1>
      I'm<br>
      <small class="">Ivan Yañez</small>
    </h1>

    <div class="row description">
      <div class="col"><hr class="first"></div>      
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

  <div class="col d-flex align-items-center ">
    <img class="align-self-center bio-image" src="http://localhost/wp-template-test/wp-content/uploads/2022/05/me-01.png" width=350 alt="pic">      
  </div>

  <div class="col-3 services-col">
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-8">
          <div class="card-body">
            <h5 class="card-title">Servicios</h5>
            <p class="card-text">Let's build quality products in programming</p>
            <a href="#" class="services-a">Show more <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- services and blog -->
<div class="row mx-5" id="services">

    <div class="col-9 px-2 serv">

      <div class="row mx-2 service">
        <?php 
        include 'services.php';
        $services_array=array_slice($services_array, 0, 6);
        foreach ( $services_array as $service ) :?>

          <div class="col-md-4"><div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech');">
            <img class="card-img d-none" src="#">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
                <small class="card-meta mb-2"><?= $service['tag'] ?></small>
                <h4 class="card-title mt-0 "><a class="text-white" herf="<?php $service['serviceUrl'] ?>"><?= $service['service'] ?></a></h4>
                <small><?= substr($service['description'], 0, 50) ?></small>
              </div>
              <div class="card-footer">
                <a href="<?php $service['serviceUrl'] ?>" class="services-a">Show more <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
      </div>

        <?php
        endforeach; 
        ?>
      </div>
      
    </div>


    <div class="col-3 px-5 blog-post" >
      <?php
      $lastposts = get_posts( array(
          'posts_per_page' => 6
      ) );
      //the_content()
      if ( $lastposts ) {
          foreach ( $lastposts as $post ) :
              setup_postdata( $post ); ?>

              <div class="card mb-3">
              <div class="row g-0">
                <div class="col-3 align-self-center">                  
                  <?php echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(), $size = 'post-thumbnail').'" class="img-fluid rounded-start" alt="...">'; ?>
                </div>
                <div class="col-8">
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
</div>

<!-- portfolio -->
<div class="col container" id="portfolio" style="height:900px;">    
  <div class="portfolio">
    <h1>My best selected portfolio</h1>
  
  <!-- Card Start -->
  <div class="card">
    <div class="row">

      <div class="col-md-7 px-3">
        <div class="card-block px-6">
          <h4 class="card-title">Top </h4>
          <p class="card-text">
            The Carousel code can be replaced with an img src, no problem. The added CSS brings shadow to the card and some adjustments to the prev/next buttons and the indicators is rounded now. As in Bootstrap 3
          </p>
          <p class="card-text">Made for usage, commonly searched for. Fork, like and use it. Just move the carousel div above the col containing the text for left alignment of images</p>
          <br>
          <a href="<?php $service['serviceUrl'] ?>" class="services-a">Go <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <!-- Carousel start -->
      <div class="col-md-5">
        <div id="CarouselTest" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#CarouselTest" data-slide-to="0" class="active"></li>
            <li data-target="#CarouselTest" data-slide-to="1"></li>
            <li data-target="#CarouselTest" data-slide-to="2"></li>

          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block" src="https://picsum.photos/450/300?image=1072" alt="">
            </div>
            <div class="carousel-item">
              <img class="d-block" src="https://picsum.photos/450/300?image=855" alt="">
            </div>
            <div class="carousel-item">
              <img class="d-block" src="https://picsum.photos/450/300?image=355" alt="">
            </div>
            <a class="carousel-control-prev" href="#CarouselTest" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#CarouselTest" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col px-2 mt-4">

    <div class="row portfolio">
      <?php 
      include 'portfolio.php';
      $portfolio_array=array_slice($portfolio_array, 0, 3);
      foreach ( $portfolio_array as $portfolio_item ) :?>

        <div class="col-md-4"><div class="card text-white card-has-bg click-col">
          
          <div class="card-img-overlay d-flex flex-column">
            <div class="card-body">
              <small class="card-meta mb-2"><?= $portfolio_item['tag'] ?></small>
              <div class="row justify-content-between">
                <h3 class="card-title mt-0 col-10"><?= $portfolio_item['portfolio'] ?></h3>
                <a class="col-2" href="<?php $portfolio_item['portfolioUrl'] ?>" class="portfolio-a">Go<i class="fa-solid fa-arrow-right"></i></a>
              </div>              
              <img class="card-img" src="https://source.unsplash.com/600x900/?tech">
            </div>
          </div>
        </div>
    </div>

    <?php
    endforeach; 
    ?>
    </div>
      
  </div>

  </div>
</div>

<div class="container" id="about" style="height:400px;">
  <div class="row about">
      <div class="col-8">
        <h1>About me</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting 
        industry. Lorem Ipsum has been the industry's standard dummy text
        ever since the 1500s, when an unknown printer took a galley of type
        and scrambled it to make a type specimen book. It has survived not 
        only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s 
        with the release of Letraset sheets containing Lorem Ipsum passages, 
        and more recently with desktop publishing software like Aldus 
        PageMaker including versions of Lorem Ipsum.</p>
      </div>
      <div class="col-1">
        
      </div>
  </div>
</div>

<script>

  const data = ['developer', 'fullstack', 'mobile'];

  async function init () {

    var i=0;

    const node = document.querySelector("#type-text");
  
    await sleep(700);
    
    while (true) {      
      await node.type(data[i]);
      await sleep(2000);
      await node.delete(data[i]);
      if(i<data.length-1){              
        i++;        
      }else{
        i=0;
      }      
      
    }
  }

  const sleep = time => new Promise(resolve => setTimeout(resolve, time))

  class TypeAsync extends HTMLSpanElement {
    get typeInterval () {
      const randomMs = 100 * Math.random()
      return randomMs < 50 ? 10 : randomMs
    }
    
    async type (text) {
      for (let character of text) {
        this.innerText += character
        await sleep(this.typeInterval)
      }
    }
    
    async delete (text) {
      for (let character of text) {
        this.innerText = this.innerText.slice(0, this.innerText.length -1)
        await sleep(this.typeInterval)
      }
    }
  }

  customElements.define('type-async', TypeAsync, { extends: 'span' })

  init()

</script>