"use strict";

//依赖模块
const gulp = require('gulp'),
    //includer = require('gulp-content-includer'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
    minifycss = require('gulp-minify-css'),
    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector'),
    uglify = require('gulp-uglify');
//压缩js
gulp.task('script',() => {
  return gulp.src('../script/**/*.*')
      .pipe(uglify())
      .pipe(rev())
      .pipe(gulp.dest('../dist/script/'))
      .pipe(rev.manifest())
      .pipe(gulp.dest('../rev/script/'))

});
//压缩css
gulp.task('css',() => {
   return gulp.src('../css/**/*.*')
        .pipe(minifycss())
        .pipe(rev())
        .pipe(gulp.dest('../dist/css'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('../rev/css/'))
});
//打包
gulp.task('pack',() => {
   return gulp.src('../{img,inc}/**/*.*')
    .pipe(gulp.dest('../dist/'))
});
//模板拼接
//gulp.task('concat',() => {
//    return gulp.src(['../page/*.html','!../{dist,inc}/','!../{dist,inc}/**/*.html'])
//    .pipe(includer({
//        includerReg:/<!\-\-#include virtual="([^"]+)"\-\->/g
//    }))
//    .pipe(gulp.dest('../dist/page/'))
//});
gulp.task('clean',() => {
    return gulp.src('../dist/**/*.*',{read: false})
    .pipe(clean({
        force: true // 只有设置为 true 时，才可以删除当前文件目前以外目录的文件
    }))
});
//修改引入文件url
gulp.task('rev',() => {
    return gulp.src(['../rev/**/*.json','../dist/{page,inc}/*.html'])
    .pipe(revCollector())
    .pipe(gulp.dest('../dist/'))
});
//监听文件修改
gulp.task('watch',() => {
    gulp.watch('../{css,page,img,inc}/**/*.*',['script','css','rev','pack','clean'])
});
//gulp.task('default',['clean','script','css','rev','pack','watch']);


