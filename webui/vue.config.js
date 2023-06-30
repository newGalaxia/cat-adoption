const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    allowedHosts: [
      'intranet.sfournage.dev.as30781.net',
    ],
  }
},)
