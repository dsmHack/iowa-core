const isGhPages = process.env.NODE_ENV === 'gh-pages' ;
const prefix = isGhPages ? '/iowa-core' : ''

module.exports = {
  assetPrefix: prefix,
  publicRuntimeConfig: {
    linkPrefix: prefix,
  },
  exportTrailingSlash: true,
  exportPathMap: function() {
    return {
      '/': { page: '/' }
    };
  }
};
