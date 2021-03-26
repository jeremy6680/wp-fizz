let mix = require("laravel-mix");
mix
    .js("assets/src/js/app.js", "assets/dist/")
    .sass("assets/src/scss/app.scss", "assets/dist/")
    .browserSync({
        proxy: "http://wpfizz.test"
    });