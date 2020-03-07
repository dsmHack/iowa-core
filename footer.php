      <footer class="footer" role="contentinfo">
          <div class="container">
              <div class="row">
                <div class="col text-center">
                  <h2>About Rethink Iowa</h2>
                  <?php $page = get_page_by_path('general-info');?>
                  <?php $footer_query = new WP_Query(array(
                    'page_id' => $page->ID,
                  ));?>
                  <?php if($footer_query -> have_posts()){ ?>
                    <?php while ($footer_query -> have_posts()){ ?>
                      <?php $footer_query -> the_post();?>
                      <p>
                        <?php the_field('boilerplate');?>
                      </p>
                      <p>
                        Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="<?php the_field('link');?>">Rethink Iowa</a>
                      </p>
                    <?php } ?>
                  <?php } ?>
                  <?php wp_reset_postdata();?>
                </div>
              </div>
          </div>
      </footer>
    </div>
    <!-- /wrapper -->

    <?php wp_footer(); ?>
  </body>
</html>
