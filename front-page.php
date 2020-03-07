<?php get_header();?>
<?php the_post();?>

<div class="container">
    <div class="row">
        <div class="col">
          <div class="title-block">
            <h1 class="text-center">
              <?php the_title();?>
            </h1>
            <hr />
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
  <div class="row">
    <div class="col">
      <?php include 'map.php';?>
    </div>
  </div>
</div>

<?php $community_query = new WP_Query(array(
  'post_type' => 'community',
));?>

<?php if ($community_query->have_posts()) { ?>
  <div class="story-post-module mb-4">
    <div class="container">
      <?php while ($community_query->have_posts()) { ?>
        <?php $community_query->the_post();?>
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
              <div class="col">
                <h2 class="text-center">
                  <a href="<?php the_permalink();?>">
                    <?php the_title();?>
                  </a>
                </h2>
                <hr />
              </div>
            </div>
            <div class="row">
            <?php foreach($stories as $story): ?>
                <article class="col-md-4 mb-4">
                  <a href="<?php echo get_permalink($story->ID);?>">
                    <?php $image = get_field('teaser_photo',  $story->ID);?>
                    <?php if(!empty($image)) { ?>
                        <img class="img-fluid mb-2" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php } ?>
                  </a>
                  <h4>
                    <a href="<?php echo get_permalink($story->ID);?>">
                      <?php echo get_the_title($story->ID);?>
                    </a>
                  </h4>
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
