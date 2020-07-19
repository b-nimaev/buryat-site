var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var clean = require('gulp-clean-css');

var path = 'buryat/';

gulp.task('sass', function (done) {
  return gulp.src(path + 'scss/style.scss')
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(clean())
    .pipe(gulp.dest(path))
    .pipe(browserSync.stream());
    done()
})

gulp.task('browsersync', function(done) {
  browserSync.init({
    proxy: "http://" + path
  });

  gulp.watch(path + 'scss/**/*.scss', gulp.series('sass'));
  gulp.watch(path + '**/*.php').on('change', browserSync.reload);
  gulp.watch(path + '**/*.js').on('change', browserSync.reload);

  done();
})

gulp.task('default', gulp.series('browsersync'));
