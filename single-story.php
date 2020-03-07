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

Date<br />
<?php the_field('date');?>

Contributors<br />
<?php if(have_rows('contributors')) { ?>
  <ul>
    <?php while(have_rows('contributors')) { ?>
      <li>
        <?php the_row();?>
        <?php echo get_sub_field('contributor_name');?>
      </li>
    <?php } ?>
  </ul>
<?php } ?>

Minority Group
<?php the_field('minority_group');?>

Street Address
<?php the_field('street_address');?>

City
<?php the_field('city');?>

Zip
<?php the_field('zip');?>

Image Gallery:
<?php
$images = get_field('image_gallery');
if( $images ): ?>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
                <a href="<?php echo esc_url($image['url']); ?>">
                     <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </a>
                <p><?php echo esc_html($image['caption']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

Tags/Categories
<?php
  $terms = wp_get_post_terms($post->ID);

  if ($terms) {
    foreach ($terms as $term) {
      echo $term;
    }
  }
?>

<h2>Community</h2>
<?php

$posts = get_field('community');

if( $posts ): ?>
    <ul>
    <?php foreach( $posts as $post):?>
        <?php setup_postdata($post); ?>
        <li>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <?php the_excerpt();?>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata();?>
<?php endif; ?>

<?php get_footer();?>
