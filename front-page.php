<?php get_header();?>
<?php the_post();?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center"><?php the_title();?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php the_content();?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php get_template_part('map');?>
</div>

<?php $community_query = new WP_Query(array(
  'post_type' => 'community',
));?>

<?php if ($community_query->have_posts()) { ?>
  <?php while ($community_query->have_posts()) { ?>
    <?php $community_query->the_post();?>
      <h2>
        <a href="<?php the_permalink();?>">
          <?php the_title();?>
        </a>
      </h2>
      <hr />
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
        <ul>
        <?php foreach( $stories as $story): ?>
            <li>
                <a href="<?php echo get_permalink($story->ID);?>">
                  <?php $image = get_field('teaser_photo',  $story->ID);?>
                  <?php if(!empty($image)) { ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  <?php } ?>
                </a>
                <a href="<?php echo get_permalink($story->ID);?>">
                  <?php echo get_the_title($story->ID);?>
                </a>
                <?php echo get_the_excerpt($story->ID);?>
            </li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <?php wp_reset_postdata();?>

    <?php } ?>
<?php } ?>

<?php wp_reset_postdata();?>

<?php get_footer();?>
