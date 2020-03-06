<?php get_header(); ?>
<?php the_post();?>

<h2>I AM A SINGLE CUSTOM POST TYPE (STORY)</h2>

  <?php if (has_post_thumbnail()) { ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_post_thumbnail();
    </a>
  <?php } ?>

  <?php endif; ?>

  <h1>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?>
    </a>
  </h1>

  <?php the_content();?>

  <h2>Do we need a pagebuilder?</h2>

<?php get_sidebar();?>

<?php get_footer();?>
