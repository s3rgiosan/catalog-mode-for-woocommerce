/* global module require process */
module.exports = function(grunt) {
  var path = require("path");

  require("load-grunt-config")(grunt, {
    configPath: path.join(process.cwd(), "grunt/config"),
    jitGrunt: {
      customTasksDir: "grunt/tasks",
      staticMappings: {
        makepot: "grunt-wp-i18n"
      }
    },
    data: {
      i18n: {
        author: "Sérgio Santos",
        support: "https://s3rgiosan.com/",
        pluginSlug: "catalog-mode-for-woocommerce",
        mainFile: "catalog-mode-for-woocommerce",
        textDomain: "catalog-mode-for-woocommerce",
        potFilename: "catalog-mode-for-woocommerce"
      },
      badges: {
        packagist_stable: "",
        packagist_downloads: "",
        packagist_license: "",
        codacy_grade: "",
        codeclimate_grade: ""
      }
    }
  });
};
