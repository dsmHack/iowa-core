(function ($, root, undefined) {
  $(function() {
    'use strict';

    $('.grid').masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      percentPosition: true,
    });
  });
})(jQuery, this);
