<?php get_header(); ?>
<?php the_post();?>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="title-block">
        <p>
          <small>
            <a href="/">Home</a> / <strong><?php the_title();?></strong>
          </small>
        </p>
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

<div class="container">
  <div class="row">
    <div class="col">
      <div class="community-information-module">
        <?php $response = wp_remote_get("https://data.iowa.gov/resource/yhbr-3t8a.json?$query=SELECT%20*%20WHERE%20primary_long_dec%20%3C=%20-93.52568000000001%20and%20primary_long_dec%20%3E=%20-93.94568%20AND%20primary_lat_dec%20%3E=%2041.360915999999996%20and%20primary_lat_dec%20%3C=%2041.780916%20and%20year%20==%202018") ?>
        <?php $body = wp_remote_retrieve_body($response) ?>
        <?php $data = json_decode($body); ?>
        <?php echo $body?>

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
      </div>
    </div>
  </div>
</div>

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
<?php if($stories) { ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center">Stories from This Community</h2>
        <hr />
      </div>
    </div>
    <div class="row">
      <?php foreach($stories as $story) { ?>
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
    <?php } ?>
  </div>
<?php } ?>

<?php get_footer();?>
