<!-- user can change route by customizer -->
<?php $image_attributes = wp_get_attachment_image_src( $attachment_id = 679 );
  if ( $image_attributes ) : 
    $image= $image_attributes[0];
  endif;
?> 

<!-- floating image -->
<img class="floating" src="<?= $image ?>">

<!--  -->
<div class="row principal" style="height:600px; ">

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
<div class="row mx-5">


    <div class="col-9 px-5 ">

      <div class="row mx-3 service">
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


    <div class="col-3 px-5 blog-post">
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

<div class="col container"  style="height:600px;">
    <p>Portfolio</p>
</div>

<div class="col container"  style="height:400px;">
   <p>Acerca</p>
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