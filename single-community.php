<?php get_header(); ?>
<?php the_post();?>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="title-block">
        <h1 class="text-center">
          <?php the_title(); ?>
        </h1>
      </div>
      <div class="content-block">
        <?php the_content();?>
      </div>
    </div>
  </div>
</div>

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

<div class="container">
  <div class="row">
    <div class="col">
      <div class="community-information-module">
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
      </div>
    </div>
  </div>
</div>

<?php if($stories){ ?>
  <ul>
    <?php foreach( $stories as $story){ ?>
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
    <?php } ?>
  </ul>
<?php } ?>

<?php get_footer();?>
