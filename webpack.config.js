var Encore = require('@symfony/webpack-encore');
var path = require('path')

Encore
  .setOutputPath('./src/Resources/public/')
  .setPublicPath('/bundles/davidannebicque/')
  .setManifestKeyPrefix('bundles/davidannebicque')

  .cleanupOutputBeforeBuild()
  .enableSourceMaps(false)
  .enableVersioning(true)
  .disableSingleRuntimeChunk()

  .addAliases({
    da_table: path.join(__dirname, '/assets/'),
  })
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
