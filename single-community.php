<?php get_header(); ?>
<?php the_post();?>

<h2>I AM A SINGLE CUSTOM POST TYPE (community)</h2>

  <?php if (has_post_thumbnail()) { ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_post_thumbnail();?>
    </a>
  <?php } ?>

  <h1>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?>
    </a>
  </h1>

  <?php the_content();?>

Zip codes:<br />
<?php if(have_rows('zip_codes')) { ?>
  <ul>
    <?php while(have_rows('zip_codes')) { ?>
      <li>
        <?php the_row();?>
        <?php echo get_sub_field('zip_code');?>
      </li>
    <?php } ?>
  </ul>
<?php } ?>

Prominent Businesses:<br />
<?php if(have_rows('prominent_businesses')) { ?>
  <ul>
    <?php while(have_rows('prominent_businesses')) { ?>
      <li>
        <?php the_row();?>
        <?php echo get_sub_field('business');?>
      </li>
    <?php } ?>
  </ul>
<?php } ?>

Average Household Income:<br />
<?php echo get_field('average_household_income');?>

School District:<br />
<?php echo get_field('school_district');?>

Median Population Age<br />
<?php echo get_field('median_population_age');?>

<h2>Stories from This Community</h2>
<?php
  $stories = get_posts(array(
    'post_type' => 'story',
    'meta_query' => array(
        array(
            'key' => 'community',
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE'
        )
    )
  ));

?>
<?php if( $stories ): ?>
  <div class="row">
  <?php foreach( $stories as $story): ?>
      <article class="col-md-4">
        <a href="<?php echo get_permalink($story->ID);?>">
          <?php $image = get_field('teaser_photo',  $story->ID);?>
          <?php if(!empty($image)) { ?>
            <div class="image">
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>
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

<?php get_footer();?>
