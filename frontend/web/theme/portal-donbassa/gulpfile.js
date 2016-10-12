var gulp = require('gulp'), // Подключаем Gulp
    sass = require('gulp-sass'), //Подключаем Sass пакет,
    browserSync = require('browser-sync'), // Подключаем Browser Sync
    concat = require('gulp-concat'), // Подключаем gulp-concat (для конкатенации файлов)
    rename = require('gulp-rename'), // Подключаем библиотеку для переименования файлов
    del = require('del'), // Подключаем библиотеку для удаления файлов и папок
    imagemin = require('gulp-imagemin'), // Подключаем библиотеку для работы с изображениями
    pngquant = require('imagemin-pngquant'), // Подключаем библиотеку для работы с png
    cache = require('gulp-cache'), // Подключаем библиотеку кеширования
    extender = require('gulp-html-extend'),
    sourcemaps = require('gulp-sourcemaps'),
    rimraf = require('rimraf'),
    argv = require('yargs').argv,
    gulpif = require('gulp-if'),
    uglify = require('gulp-uglify'),
    plumber = require('gulp-plumber');

var postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    cssnano = require('cssnano'),
    pxtorem = require('postcss-pxtorem'),
    short = require('postcss-short'),
    stylefmt = require('stylefmt'),
    assets  = require('postcss-assets'),
    shortspacing = require('postcss-short-spacing'),
    focus = require('postcss-focus'),
    sorting = require('postcss-sorting'),
    fixes = require('postcss-fixes'),
    stylelint = require('stylelint'),
    messages = require('postcss-browser-reporter');


gulp.task('css-libs', function() { // Создаем таск Sass
    var processors = [
        cssnano
    ]
    return gulp.src([
            'app/libs/normalize-css/normalize.css',
        ]) // Берем источник
        .pipe(postcss(processors))
        .pipe(concat('libs.min.css'))
        .pipe(gulp.dest('css')) // Выгружаем результата в папку app/css
        .pipe(browserSync.reload({
            stream: true
        })) // Обновляем CSS на странице при изменении
});

gulp.task('js-libs', function() {
    return gulp.src([ // Берем все необходимые библиотеки
            'app/libs/jquery/dist/jquery.min.js'
        ])
        .pipe(concat('libs.min.js')) // Собираем их в кучу в новом файле libs.min.js
        .pipe(uglify()) // Сжимаем JS файл
        .pipe(gulp.dest('js')); // Выгружаем в папку app/js
});

gulp.task('sass', function() { // Создаем таск Sass
    var processors = [
        assets,
        short,
        focus,
        autoprefixer(['last 5 versions', '> 5%', 'ie 8', 'ie 7'], {
            cascade: true
        }),
        sorting(),
        // pxtorem({
        //     rootValue: 14,
        //     replace: false
        // }),
        stylefmt,
        stylelint(),

        messages({
          selector: 'body:before'
        }),
        fixes,
        cssnano,
    ];
    return gulp.src('app/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(rename({
            suffix: ".min",
            extname: ".css"
        }))
        .pipe(sourcemaps.write('.', { sourceRoot: 'css-source' }))
        .pipe(gulp.dest('css'))
        .pipe(browserSync.reload({
            stream: true
        }));
});

gulp.task('browser-sync', function() { // Создаем таск browser-sync
    browserSync({ // Выполняем browserSync
        proxy: {
            target: 'portal-donbassa' // Директория для сервера - app
        },
        ghostMode: {
            clicks: true,
            forms: true,
            scroll: true
        },
        notify: false // Отключаем уведомления
    });
});

gulp.task('compress', ['clean'], function() {
  return gulp.src('app/js/*.js')
  .pipe(plumber())
  .pipe(concat('script.js'))
  .pipe(rename({
      suffix: ".min",
      extname: ".js"
  }))
  .pipe(gulpif(argv.production, uglify())) // <- добавляем вот эту строчку
  .pipe(plumber.stop())
  .pipe(gulp.dest('js'));

});

gulp.task("clean", function (cb) {
  rimraf('./js/script.min.js', cb);
});

gulp.task('extend', function () {
    gulp.src('./app/html/*.html')
        .pipe(extender({annotations:true,verbose:false})) // default options
        .pipe(gulp.dest('./'))

});

gulp.task('watch', ['browser-sync', 'compress'], function() {
    gulp.watch('app/img/**/*', ['img']);
    gulp.watch('app/sass/**/*.scss', ['sass']); // Наблюдение за sass файлами в папке sass
    gulp.watch(['./app/html/*.html'], ['extend']);
    gulp.watch('./**/*.html', browserSync.reload); // Наблюдение за HTML файлами в корне проекта
    gulp.watch('app/js/*', function() {
       gulp.run('compress');
  }); // Наблюдение за JS файлами в папке js
});

gulp.task('img', function() {
    return gulp.src('app/img/**/*')
        .pipe(cache(imagemin({
            interlaced: true,
            progressive: true,
            svgoPlugins: [{
                removeViewBox: false
            }],
            use: [pngquant()]
        })))
        .pipe(gulp.dest('img'))
        .pipe(browserSync.reload({
            stream: true
        }));
});


gulp.task('build', ['img', 'sass', 'scripts'], function() {

    var buildCss = gulp.src([ // Переносим библиотеки в продакшен
            'app/css/main.css',
            'app/css/libs.min.css'
        ])
        .pipe(gulp.dest('css'))

    var buildFonts = gulp.src('app/fonts/**/*') // Переносим шрифты в продакшен
        .pipe(gulp.dest('fonts'))

    var buildJs = gulp.src('app/js/**/*') // Переносим скрипты в продакшен
        .pipe(gulp.dest('js'))

});


gulp.task('clear', function(callback) {
    return cache.clearAll();
});

gulp.task('default', ['watch']);
