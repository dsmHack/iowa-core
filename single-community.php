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

Need to be able to 'relate' to Story
  Communities Profiles
      - Name
      - Included zip codes
      - Avg household income
      - School district
      - Prominent businesses
      - Median population age

<?php get_footer();?>
