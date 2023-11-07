var Encore = require('@symfony/webpack-encore');
var path = require('path')

Encore
  // .setOutputPath('./public/')
  // .setPublicPath('/public/')
  // .setManifestKeyPrefix('bundles/davidannebicque')
  .setOutputPath('./src/Resources/public/')
  .setPublicPath('')
  .setManifestKeyPrefix('')

  .cleanupOutputBeforeBuild()
  .enableSourceMaps(true)
  .enableVersioning(true)
  .disableSingleRuntimeChunk()

  .addEntry('table', '/assets/js/tableBundle.js')

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
