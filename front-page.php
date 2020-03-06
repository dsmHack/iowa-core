<?php get_header();?>
<?php the_post();?>

<?php the_title();?>
<?php the_content();?>

<?php get_template_part('map');?>

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
              <?php if (has_post_thumbnail()) { ?>
                <div class="story-image">
                  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail(array(120,120));?>
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
