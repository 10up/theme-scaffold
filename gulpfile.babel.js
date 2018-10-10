import gulp from 'gulp';
import requireDir from 'require-dir';
import livereload from 'gulp-livereload';

requireDir( './gulp-tasks' );

gulp.task( 'js', gulp.series( 'webpack' ) );

gulp.task( 'cssprocess', gulp.series( 'csslint', 'css', 'cssnano', 'cssclean' ) );

gulp.task( 'watch', () => {
	process.env.NODE_ENV = 'development';
	livereload.listen( { basePath: 'dist' } );
	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], gulp.series( 'cssprocess' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js' ) );
} );

gulp.task( 'default', gulp.parallel( 'cssprocess', gulp.series( 'set-prod-node-env', 'webpack' ) ) );
