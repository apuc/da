// команды для установки пакетов
// npm install -g gulp
//npm i gulp pump gulp-uglify gulp-rename gulp-postcss cssnano --save-dev

var gulp = require('gulp'),
    pump = require('pump'),
    uglify = require('gulp-uglify'), // Подключаем gulp-uglifyjs (для сжатия JS)
    rename = require('gulp-rename'), // Подключаем библиотеку для переименования файлов
    postcss = require('gulp-postcss'),//Блиотека-парсер стилей для работы с postcss-плагинами
    cssnano = require('cssnano');//postcss-плагин, для минификации CSS кода, идущего на продакшен.


gulp.task('compress-js', function () {
    pump([
            gulp.src('frontend/web/js/raw/*.js'),
            (rename({
                suffix: ".min",// Добавляем суффикс .min
                extname: ".js"// Добавляем окончание .js
            })),
            uglify(),
            gulp.dest('frontend/web/js/')
        ]
    );
});

gulp.task('compress-theme-js', function () {
    pump([
            gulp.src('frontend/web/theme/portal-donbassa/js/raw/*.js'),
            (rename({
                suffix: ".min",// Добавляем суффикс .min
                extname: ".js"// Добавляем окончание .js
            })),
            uglify(),
            gulp.dest('frontend/web/theme/portal-donbassa/js/')
        ]
    );
});

gulp.task('compress-css', function () { // Создаем таск css-libs
    return gulp.src(['frontend/web/css/raw/*.css']) // Берем источник
        .pipe(postcss(cssnano))// сжымаем
        .pipe(rename({
            suffix: ".min",// Добавляем суффикс .min
            extname: ".css"// Добавляем окончание .css
        }))
        .pipe(gulp.dest('frontend/web/css/')) // Выгружаем результата в папку app/css
});
gulp.task('compress-fancybox-css', function () { // Создаем таск css-libs
    return gulp.src(['frontend/web/theme/portal-donbassa/css/fancybox/raw/*.css']) // Берем источник
        .pipe(postcss(cssnano))// сжымаем
        .pipe(rename({
            suffix: ".min",// Добавляем суффикс .min
            extname: ".css"// Добавляем окончание .css
        }))
        .pipe(gulp.dest('frontend/web/theme/portal-donbassa/css/fancybox/')) // Выгружаем результата в папку app/css
});
gulp.task('default', ['compress-js', 'compress-theme-js', 'compress-css', 'compress-fancybox-css']);

