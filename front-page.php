<?php get_header();?>
<?php the_post();?>

<div class="container">
    <div class="row">
        <div class="col">
          <div class="title-block">
            <h1 class="text-center"><?php the_title();?></h1>
            <div class="col">
              <div class="lead">
                <?php the_content();?>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="container-fluid">
  <?php include 'map.php';?>
</div>

<?php $community_query = new WP_Query(array(
  'post_type' => 'community',
));?>

<?php if ($community_query->have_posts()) { ?>
  <div class="story-post-module">
    <div class="container">
      <?php while ($community_query->have_posts()) { ?>
        <?php $community_query->the_post();?>
          <div class="row">
            <div class="col">
              <h2 class="text-center">
                <a href="<?php the_permalink();?>">
                  <?php the_title();?>
                </a>
              </h2>
              <hr />
            </div>
          </div>
          <?php
            $stories = get_posts(array(
              'post_type' => 'story',
              'meta_query' => array(
                  array(
                      'key' => 'community',
                      'value' => '"' . $post->ID . '"',
                      'compare' => 'LIKE'
                  )
              )
            ));
          ?>
          <?php if( $stories ): ?>
            <div class="row">
            <?php foreach( $stories as $story): ?>
                <article class="col-md-4 mb-2">
                  <a href="<?php echo get_permalink($story->ID);?>">
                    <?php $image = get_field('teaser_photo',  $story->ID);?>
                    <?php if(!empty($image)) { ?>
                        <img class="img-fluid" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php } ?>
                  </a>
                  <h3>
                    <a href="<?php echo get_permalink($story->ID);?>">
                      <?php echo get_the_title($story->ID);?>
                    </a>
                  </h3>
                  <p>
                    <?php echo get_the_excerpt($story->ID);?>
                  </p>
                </article>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php wp_reset_postdata();?>
      <?php } ?>
    </div>
  </div>
<?php } ?>
<?php wp_reset_postdata();?>


<?php get_footer();?>
