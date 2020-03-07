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

<?php $custom_terms = get_terms('community');?>

<?php foreach ($custom_terms as $term) { ?>
  Term Slug: <?php echo $term->slug;?>

  <?php $story_query = new WP_Query(array(
    'post_type' => 'story',
    'tax_query' => array(
      array (
        'taxonomy' => 'community',
        'field' => 'slug',
        'terms' => $term->slug,
      )
    ),
  ));?>

  <?php if ($story_query->have_posts()) { ?>
    <ul>
      <?php while ($story_query->have_posts()) { ?>
        <?php $story_query->the_post();?>
          <li>
            <article>
              <?php $image = get_field('teaser_photo');?>

              <?php if ($image) { ?>
                <div class="story-image">
                  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                    <?php echo $image;?>
                  </a>
                </div>
              <?php } ?>
              <div class="story-title">
                <h3>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
              </div>
              <div class="story-excerpt">
                <?php echo get_the_excerpt();?>
              </div>
            </article>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>
  <?php wp_reset_postdata();?>
<?php } ?>

<?php get_footer();?>
