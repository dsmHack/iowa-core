const isGhPages = process.env.NODE_ENV === 'gh-pages';

module.exports = {
  assetPrefix: isGhPages ? '/iowa-core' : '',
  exportTrailingSlash: true,
  exportPathMap: function() {
    return {
      '/': { page: '/' }
    };
  }
};
