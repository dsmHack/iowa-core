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

Teaser Photo<br />
<?php the_field('teaser_photo');?>

Date<br />
<?php the_field('date');?>

Contributors<br />
<?php if(have_rows('contributors')) { ?>
  <ul>
    <?php while(have_rows('contributors')) { ?>
      <li>
        <?php the_row();?>
        <?php echo get_sub_field('contributor');?>
      </li>
    <?php } ?>
  </ul>
<?php } ?>

Minority Group<br />
<?php the_field('minority_group');?>

Street Address<br />
<?php the_field('street_address');?>

City<br />
<?php the_field('city');?>

Zip<br />
<?php the_field('zip');?>

Image Gallery:
<?php
  $images = get_field('image_gallery');
  $size = 'full';
?>
<?php if($images){ ?>
  <ul>
    <?php foreach($images as $image_id){ ?>
      <li>
        <?php echo wp_get_attachment_image($image_id, $size);?>
      </li>
    <?php } ?>
  </ul>
<?php } ?>

Tags/Categories
<?php
  $terms = get_the_terms( $post->ID , 'category');

  foreach ($terms as $term) {
    echo $term->name;
  }
?>

Industry Type (TBD) <br />

  <h2>SHOW ME THE COMMUNITY THAT I BELONG TO</h2>



<?php get_footer();?>
