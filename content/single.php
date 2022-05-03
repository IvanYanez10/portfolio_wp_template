<div class="row align-items-center" style="height:600px;">
    <div class="col">
      
    </div>
    <div class="col">
      
    </div>
    <div class="col">
      
    </div>
  </div>
</div>

<div class="row mx-5">
    <div class="col-9 px-5">
      One of three columns
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