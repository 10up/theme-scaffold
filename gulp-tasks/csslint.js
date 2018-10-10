import gulp from 'gulp';
import gulpStyleLint from 'gulp-stylelint';

gulp.task( 'csslint', () => {
	gulp.src( './assets/css/**/*.css' )
			.pipe( gulpStyleLint( {
				failAfterError: false,
				fix: true,
				debug: false,
				reporters: [
					{formatter: 'verbose', console: true},
				]
			} ) );
} );
