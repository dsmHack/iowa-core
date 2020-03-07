<?php get_header(); ?>
<?php the_post();?>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="title-block">
        <h1 class="text-center">
          <?php the_title(); ?>
        </h1>
        <?php $story_date = get_field('date');?>
        <?php if($story_date) { ?>
          <p>
            <em><?php echo $story_date;?></em>
          </p>
        <?php } ?>
        <?php if(have_rows('contributors')) { ?>
          <ul class="story-contributor-list list-unstyled text-center">
            <?php while(have_rows('contributors')) { ?>
              <li>
                <?php the_row();?>
                <?php echo get_sub_field('contributor_name');?>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
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
      <div class="story-information-module">
        <h4>Minority Group</h4>
        <p><?php the_field('minority_group');?></p>
        <h4>Address</h4>
        <p>
          <?php the_field('street_address');?>, <?php the_field('city');?>, <?php the_field('zip');?>
        </p>
        <?php $terms = wp_get_post_terms($post->ID);?>
        <?php if ($terms) { ?>
          <h4>Categories</h4>
          <ul class="category-list">
            <?php foreach ($terms as $term) { ?>
                <li><?php echo $term;?></li>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<?php $images = get_field('image_gallery');?>
  <?php if($images) { ?>
    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="text-center">Gallery</h2>
        </div>
      </div>
      <div class="grid">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
        <?php foreach( $images as $image ){ ?>
          <div class="grid-item">
            <img class="img-fluid"
              src="<?php echo esc_url($image['sizes']['large']); ?>"
              alt="<?php echo esc_attr($image['alt']); ?>"
            />
          </div>
        <?php } ?>
      </div>
    </div>
<?php } ?>

<?php $posts = get_field('community');?>
<?php if($posts) { ?>
  <div class="community-module">
    <h2>About the Community</h2>
    <?php foreach( $posts as $post){ ?>
      <?php setup_postdata($post);?>
      <article>
        <a href="<?php echo get_permalink($story->ID);?>">
          <?php $image = get_field('image',  $story->ID);?>
          <?php if(!empty($image)) { ?>
            <div class="image">
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>
          <?php } ?>
        </a>
        <h2>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
        <div class="excerpt">
          <?php the_excerpt();?>
        </div>
      </article>

      <?php break;?>

    <?php } ?>

    <?php wp_reset_postdata();?>

  </div>
<?php } ?>

<?php get_footer();?>
