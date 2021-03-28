/* code inspired by solutions provided here:
* https://github.com/JeffreyWay/laravel-mix/issues/67#issuecomment-528844842
* https://github.com/JeffreyWay/laravel-mix/issues/982#issuecomment-454855384
*/

    const fs = require('fs');
    const path = require('path');
    const mix = require('laravel-mix');

    mix.js("assets/src/js/app.js", "assets/dist/")
    .sass("assets/src/scss/app.scss", "assets/dist/")
    .browserSync({
        proxy: "http://wpfizz.test"
    });

    const folders = fs.readdirSync(path.resolve(__dirname, 'views', 'components' ), 'utf-8')  
    
    for (let folder of folders) {
        if(folder != '.DS_Store') {
            mix.sass(`views/components/${folder}/style.scss`, 'assets/dist/components.css');
          }
       
    }