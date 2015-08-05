var gulp = require('gulp');
var coffee = require('gulp-coffee');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

gulp.task('coffee', function() {
    gulp.src('./src/*.coffee')
        .pipe(coffee({bare: true}))
        .pipe(gulp.dest('./stage/js/'))
});

gulp.task('merge', function() {
    gulp.src(['./node_modules/bowser/bowser.min.js', './stage/js/*.js'])
        .pipe(concat('remoteDebug.js', {newLine: ';'}))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js/'));
});

gulp.task('uglify', function(){
    gulp.src('./dist/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js/'));
});

gulp.task('default', ['coffee', 'merge'], function() {
    // place code for your default task here
});