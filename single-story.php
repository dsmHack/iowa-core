<?php get_header(); ?>
<?php the_post();?>

<div class="container">
  <div class="row">
    <div class="col">

    </div>
  </div>
</div>

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

<div class="community-module">
  <h2 class="text-center">Community</h2>

</div>

<?php $posts = get_field('community');?>
<?php if($posts) { ?>
  <div class="community-module">
    <?php foreach( $posts as $post){ ?>
      <?php setup_postdata($post);?>
      <article>
        <h2>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
        <div class="excerpt">
          <?php the_excerpt();?>
        </div>
      </article>
    <?php } ?>
    <?php wp_reset_postdata();?>
  </div>
<?php } ?>

<?php get_footer();?>
