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
      <div class="content-block mb-4">
        <?php the_content();?>
      </div>
    </div>
  </div>
</div>

<div class="container mb-4">
  <div class="row">
    <div class="col">
      <div class="story-information-module mb-4">
        <h2 class="text-center">Community Data</h2>
        <hr />
        <div class="row">
          <div class="col">
            <?php if(have_rows('zip_codes')) { ?>
              <h4>Zip codes:</h4>
              <ul>
                <?php while(have_rows('zip_codes')) { ?>
                  <li>
                    <?php the_row();?>
                    <?php echo get_sub_field('zip_code');?>
                  </li>
                <?php } ?>
              </ul>
            <?php } ?>

            <?php if(have_rows('prominent_businesses')) { ?>
              <h4>Prominent Businesses:</h4>
              <ul>
                <?php while(have_rows('prominent_businesses')) { ?>
                  <li>
                    <?php the_row();?>
                    <?php echo get_sub_field('business');?>
                  </li>
                <?php } ?>
              </ul>
            <?php } ?>

            <?php if(get_field('average_household_income')) { ?>
              <h4>Average Household Income:</h4>
              <p>
                <?php the_field('average_household_income');?>
              </p>
            <?php } ?>

            <?php if(get_field('school_district')) { ?>
              <h4>School District:</h4>
              <p>
                <?php the_field('school_district');?>
              </p>
            <?php } ?>

            <?php if(get_field('median_population_age')) { ?>
              <h4>Median Population Age</h4>
              <p>
                <?php the_field('median_population_age');?>
              </p>
            <?php } ?>
          </div>
          <div class="col">
            <h4>Income per Capita (U.S. Dollars)</h4>
            <p id="dollars-per-capita-income"></p>

            <h4>Unemployment Benefits Paid to <?php echo get_the_title();?> (2019)</h4>
            <p id="unemployment-benefits-paid-to-this-county"></p>

            <h4>Total Weeks Compensated</h4>
            <p id="total-weeks-compensated"></p>

            <h5>Recipients</h5>
            <p id="recipients"></p>
          </div>
        </div>

        <hr />
        <p class="text-center">
          <small>Information is sourced from <a href="https://data.iowa.gov/">Iowa Census Data</a> and is intended to be as accurate as possible.</small>
        </p>
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
  <div class="container mb-4">
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
              <img class="img-fluid mb-2" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
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
  </div>
<?php } ?>

<script>
  var county = <?php echo json_encode(get_field('county'));?>;

  console.log("county", county);

  fetch(`https://data.iowa.gov/resource/st2k-2ti2.json?$query= SELECT * where date between '2018-01-10T12:00:00' and '2019-01-10T14:00:00' and variable_code = 'CAINC1-3' and name='${county}, IA'`)
  .then(response=>response.json())
  .then(function(data){
    console.log(data);

    var dollarsPerCapitaIncome = data[0].value;
    var dpci = document.getElementById('dollars-per-capita-income');
    dpci.textContent = '$' + dollarsPerCapitaIncome;
  })

  fetch(`https://data.iowa.gov/resource/yhbr-3t8a.json?$query=SELECT * where year='2019' and county_name='${county}'`)
  .then(response=>response.json())
  .then(function(data){
    console.log(data);

    var benefitsPaid = data[0].benefits_paid;
    document.getElementById('unemployment-benefits-paid-to-this-county').textContent = '$' + benefitsPaid;

    var weeksCompensated = data[0].weeks_compensated;
    document.getElementById('total-weeks-compensated').textContent = weeksCompensated;

    var recipients = data[0].recipients;
    document.getElementById('recipients').textContent = recipients;

  })
</script>

<?php get_footer();?>
