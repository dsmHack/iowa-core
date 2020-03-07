(function ($, root, undefined) {
  $(function() {
    'use strict';

    var $grid = $('.grid').masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      gutter: '.gutter-sizer',
      percentPosition: true,
    });

    $grid.imagesLoaded().progress( function() {
      $grid.masonry('layout');
    });
  });
})(jQuery, this);

