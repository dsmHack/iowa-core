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

<h2>LOOP THROUGH RELATED STORIES</h2>


<?php get_footer();?>
