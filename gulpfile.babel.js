import gulp from 'gulp';
import requireDir from 'require-dir';
import livereload from 'gulp-livereload';

requireDir( './gulp-tasks' );

gulp.task( 'js', gulp.series( 'webpack' ) );

gulp.task( 'css', gulp.series( 'cssnext', 'cssnano', 'cssclean' ) );

gulp.task( 'watch', () => {
	livereload.listen( { basePath: 'dist' } );
	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], gulp.series( 'css' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js' ) );
} );

gulp.task( 'default', gulp.parallel( 'css', 'webpack' ) );
