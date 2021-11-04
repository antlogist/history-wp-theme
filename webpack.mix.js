const mix = require("laravel-mix");
//
//mix.copy('images/', 'dist/images/', false);

mix.sass("resources/assets/sass/app.scss", "dist/css/all.css");
// mix.sass("resources/assets/sass/libs.scss", "dist/css/libs.css");

// mix.js([
//   "resources/assets/js/customization/theme-customize.js"
// ], "dist/js/theme-customize.js");

// mix.js([
//   "resources/assets/js/baseObject.js",
//   "resources/assets/js/nav/nav.js",
//   "resources/assets/js/pdf/pdf.js",
//   "resources/assets/js/init.js"
// ], "dist/js/all.js");

// mix.copy("resources/assets/libs/pdf/pdf.js", "dist/js/pdf/");
// mix.copy("resources/assets/libs/pdf/pdf.worker.js", "dist/js/pdf/");
// mix.copy("resources/assets/libs/pdf-legacy/pdf.js", "dist/js/pdf-legacy/");
// mix.copy("resources/assets/libs/pdf-legacy/pdf.worker.js", "dist/js/pdf-legacy/");

//Admin
mix.copy("resources/assets/admin/js/pdfMetabox.js", "dist/admin/js/pdf/");


//Minification
// mix.minify(['dist/css/all.css', 'dist/css/libs.css']);
// mix.minify(['dist/js/theme-customize.js', 'dist/js/all.js', 'dist/js/pdf/pdf.js', 'dist/js/pdf-legacy/pdf.js']);
