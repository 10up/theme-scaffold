import gulp from 'gulp';
import requireDir from 'require-dir';
import browserSync from 'browser-sync';

requireDir( './gulp-tasks' );

const bs = browserSync.create();

gulp.task( 'bs-reload-css', ( cb ) => {
	bs.reload('*.css');
	cb();
});

gulp.task( 'bs-reload', ( cb ) => {
	bs.reload();
	cb();
});

gulp.task( 'js', gulp.series( 'webpack' ) );

gulp.task( 'cssprocess', gulp.series( 'css', 'cssnano', 'cssclean' ) );

gulp.task( 'watch', () => {
	process.env.NODE_ENV = 'development';
	bs.init({
		proxy: 'local-theme-url.test',
		snippetOptions: {
			whitelist: ["/wp-admin/admin-ajax.php"],
			blacklist: ["/wp-admin/**"]
		}
	});
	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], gulp.series( 'cssprocess', 'bs-reload-css' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js', 'bs-reload' ) );
} );

gulp.task( 'default', gulp.parallel( 'cssprocess', gulp.series( 'set-prod-node-env', 'webpack' ) ) );
