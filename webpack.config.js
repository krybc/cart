var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .autoProvidejQuery()
    .enableSassLoader()
    .enableVersioning(true)
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', ['./assets/scss/app.scss'])
    .enableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();