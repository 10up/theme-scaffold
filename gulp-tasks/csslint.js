import gulp from 'gulp';
import gulpStyleLint from 'gulp-stylelint';

gulp.task( 'csslint', () => {
	gulp.src( './assets/css/**/*.css' )
		.pipe( gulpStyleLint( {
			failAfterError: false,
			debug: false,
			fix: true,
			reporters: [
				{
					formatter: 'verbose',
					console: true
				},
			]
		} ) )
		.pipe( gulp.dest( './assets/css' ) );
} );
