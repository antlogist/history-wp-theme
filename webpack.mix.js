const mix = require("laravel-mix");
//
//mix.copy('images/', 'dist/images/', false);

mix.sass("resources/assets/sass/app.scss", "dist/css/all.css");
mix.sass("resources/assets/sass/libs.scss", "dist/css/libs.css");

mix.js([
  "resources/assets/js/customization/theme-customize.js"
], "dist/js/theme-customize.js");

mix.js([
  "resources/assets/js/baseObject.js",
  "resources/assets/js/nav/nav.js",
  "resources/assets/js/pdf/pdf.js",
  "resources/assets/js/init.js"
], "dist/js/all.js");

//pdf
// mix.copy("resources/assets/libs/pdf/pdf.js", "dist/js/");
// mix.copy("resources/assets/libs/pdf/pdf.worker.js", "dist/js/");

// mix.minify(['dist/css/all.css', 'dist/css/libs.css']);
// mix.minify(['dist/js/theme-customize.js', 'dist/js/all.js']);
