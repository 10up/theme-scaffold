import gulp from 'gulp';
import browserSync from 'browser-sync';
import requireDir from 'require-dir';

requireDir( './gulp-tasks' );

// We store some config objects here. So, let's load:
const packageJson = require('./package.json');
// Create a BrowserSync instance:
const bs = browserSync.create();
const proxyUrl = packageJson.browserSync.proxyUrl;

gulp.task( 'bs-reload-css', ( cb ) => {
	bs.reload('*.css');
	cb();
});

gulp.task( 'bs-reload', ( cb ) => {
	bs.reload();
	cb();
});

gulp.task( 'js', gulp.series( 'webpack' ) );

gulp.task( 'cssprocess', gulp.series( 'lint-css', 'css', 'cssnano', 'cssclean' ) );

gulp.task( 'watch', () => {
	process.env.NODE_ENV = 'development';

	if ( proxyUrl ) {
		// https://browsersync.io/docs/options
		bs.init({
			proxy: proxyUrl,
			snippetOptions: {
				whitelist: ["/wp-admin/admin-ajax.php"],
				blacklist: ["/wp-admin/**"]
			}
		});
	}

	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], gulp.series( 'cssprocess', 'bs-reload-css' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js', 'bs-reload' ) );
} );

gulp.task( 'default', gulp.parallel( 'cssprocess', gulp.series( 'set-prod-node-env', 'webpack' ) ) );
