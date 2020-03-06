<?php get_header(); ?>
<?php the_post();?>

<h2>I AM A TAXONOMY TERM (COMMUNITY) PAGE</h2>

  <h1>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?>
    </a>
  </h1>
  <?php the_content();?>


<?php get_sidebar();?>

<?php get_footer();?>
