const mix = require("laravel-mix");
//
//mix.copy('images/', 'dist/images/', false);

mix.sass("resources/assets/sass/app.scss", "dist/css/all.css");

mix.js([
  "resources/assets/js/baseObject.js"
], "dist/js/all.js");
