'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var gutil = require('gulp-util');

gulp.task('sass', function () {
    gulp.src('./sass/**/*.scss')
        .pipe(sass({compass: true}).on('error', sass.logError))
        .pipe(gulp.dest('./css/'));
});

gulp.task('sass:watch', ['sass'], function () {
    gulp.watch('./sass/**/*.scss', ['sass']);
});
