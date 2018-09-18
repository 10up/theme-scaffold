import gulp from 'gulp';
import browserSync from 'browser-sync';
import requireDir from 'require-dir';
import requireUncached from 'require-uncached';

requireDir( './gulp-tasks' );

var packageJson = require('../../../package.json');

/**
 * Conditionally set up BrowserSync.
 * Only run BrowserSync if packageJson.browserSync.live = true.
 */

// Create a BrowserSync instance:
const server = browserSync.create();

// Initialize the BrowserSync server conditionally:
function serve( done ) {
	if ( packageJson.browserSync.live ) {
		server.init( {
			proxy: packageJson.browserSync.proxyUrl,
			liveReload: true,
			open: false, // Automatically open project in new tab?
			snippetOptions: {
				whitelist: ['/wp-admin/admin-ajax.php'],
				blacklist: ['/wp-admin/**']
			}
		});
	}
	done();
}

// Reload the live site:
function reload( done ) {
	packageJson = requireUncached('../../../package.json');

	if ( packageJson.browserSync.live ) {
		if ( server.paused ) {
			server.resume();
		}
		server.reload();
	} else {
		server.pause();
	}
	done();
}

gulp.task( 'js', gulp.series( 'webpack' ) );

gulp.task( 'cssprocess', gulp.series( 'css', 'cssnano', 'cssclean' ) );

gulp.task( 'watch', () => {
	process.env.NODE_ENV = 'development';

	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], gulp.series( 'cssprocess', 'reload' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js', 'reload' ) );
} );

gulp.task( 'default', gulp.parallel( 'cssprocess', gulp.series( 'set-prod-node-env', 'webpack' ) ) );
