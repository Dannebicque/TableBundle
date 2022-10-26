var Encore = require('@symfony/webpack-encore');
var path = require('path')

Encore
  .setOutputPath('./public/')
  .setPublicPath('/public/')
  .setManifestKeyPrefix('bundles/davidannebicque')

  .cleanupOutputBeforeBuild()
  .enableSourceMaps(true)
  .enableVersioning(true)
  .disableSingleRuntimeChunk()

  .addEntry('table', '/assets/tableBundle.js')


  .configureCssMinimizerPlugin((options) => {
    options.minimizerOptions = {
      preset: [
        'default',
        {
          // disabled to fix these issues: https://github.com/EasyCorp/EasyAdminBundle/pull/5171
          svgo: false,
        },
      ]
    };
  })
;

module.exports = Encore.getWebpackConfig();
