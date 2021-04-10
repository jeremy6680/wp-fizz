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

    const folders = fs.readdirSync(path.resolve(__dirname, 'templates', 'layouts' ), 'utf-8')  
    
    for (let folder of folders) {
        if(folder != '.DS_Store') {
            mix.sass(`templates/layouts/${folder}/style.scss`, 'assets/dist/layouts.css');
          }
       
    }

    const componentfolders = fs.readdirSync(path.resolve(__dirname, 'components' ), 'utf-8')  
    
    for (let componentfolder of componentfolders) {
        if(componentfolder != '.DS_Store' && componentfolder != 'index.php') {
            mix.sass(`components/${componentfolder}/style.scss`, 'assets/dist/components.css');
          }
       
    }

    const blockfolders = fs.readdirSync(path.resolve(__dirname, 'templates', 'blocks' ), 'utf-8')  
    
    for (let blockfolder of blockfolders) {
        if(blockfolder != '.DS_Store' && blockfolder != 'index.php') {
            mix.sass(`templates/blocks/${blockfolder}/style.scss`, 'assets/dist/blocks.css');
          }
       
    }


