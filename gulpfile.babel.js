import gulp from 'gulp';
import browserSync from 'browser-sync';
import requireDir from 'require-dir';

requireDir( './gulp-tasks' );

var packageJson = require('../../../package.json');



gulp.task( 'js', gulp.series( 'webpack' ) );

gulp.task( 'cssprocess', gulp.series( 'css', 'cssnano', 'cssclean' ) );

gulp.task( 'watch', () => {
	process.env.NODE_ENV = 'development';

	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], gulp.series( 'cssprocess', 'reload' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js', 'reload' ) );
} );

gulp.task( 'default', gulp.parallel( 'cssprocess', gulp.series( 'set-prod-node-env', 'webpack' ) ) );
