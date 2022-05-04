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

<!-- floating image -->
  <img class="floating" src="<?= $image ?>">

<!-- portfolio -->
<div class="container" id="portfolio">    

    <h1>My best selected portfolio</h1>

    <div class="">
      <?php 
        include 'portfolio.php';
        $top_project=$portfolio_array[0];
      ?>
      <article class="postcard dark blue">
        <a class="postcard__img_link" href="#">
          <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
        </a>
        <div class="postcard__text">
          <h1 class="postcard__title blue"><a href="#"><?= $top_project['portfolio'] ?></a></h1>
          <div class="postcard__subtitle small">
            <p><i class="fas fa-calendar-alt mr-2"></i>  bussines</p>
          </div>
          <div class="postcard__bar"></div>
          <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum dolores nobis enim quidem excepturi, illum quos!</div>
          <ul class="postcard__tagbox">
            <li class="tag__item"><i class="fas fa-tag mr-2"></i> <?= $top_project['tag'] ?></li>
            <li class="tag__item"><i class="fas fa-clock mr-2"></i>  15 min</li>
            <li class="tag__item play blue">
              <a href="#"><i class="fas fa-play mr-2"></i>  Go</a>
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
        
        <article class="postcard dark postcard-item <?= $colors[$col_ind] ?>" >
          <a class="postcard__img_link" href="#">
            <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
          </a>
          <div class="postcard__text">
            <h1 class="postcard__title blue"><a href="#"><?= $portfolio_item['portfolio'] ?></a></h1>
            <div class="postcard__subtitle small">
              <p><i class="fa-solid fa-circle-notch"></i> bussines </p>
            </div>
            <div class="postcard__bar"></div>
            <div class="postcard__preview-txt"><?= substr($portfolio_item['description'], 0, 80) ?></div>
            <ul class="postcard__tagbox">
              <li class="tag__item"><i class="fas fa-tag mr-2"></i> <?= $portfolio_item['tag'] ?></li>
              <li class="tag__item"><i class="fas fa-clock mr-2"></i> 15min</li>
              <li class="tag__item play blue">
                <a href="#"><i class="fas fa-play mr-2"></i> Go</a>
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