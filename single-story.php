<?php get_header(); ?>
<?php the_post();?>

<h2>I AM A SINGLE CUSTOM POST TYPE (STORY)</h2>

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
  - Date
  - Name(s)
  - Industry Type
  - Minority Group
  - Location (Address, City, Zip)
  - Upload video
  - Upload photo
  - Description/story tect
  - Headline
  - Tags (able to select multiple)
      - Small Business
      - Entertainment
      - Minority Owned
      - Women Owned
      - Veteran Owned
      - Community
      - Impact
      - Supplier Diversity

  <h2>Do we need a pagebuilder?</h2>
  <h2>SHOW ME THE TAXONOMY THAT I BELONG TO</h2>

<?php get_footer();?>
