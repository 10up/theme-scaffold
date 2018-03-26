import gulp from 'gulp';
import del from 'del';

gulp.task( 'cssclean', function( cb ) {
	del( ['./dist/*.css'] );
	cb();
} );