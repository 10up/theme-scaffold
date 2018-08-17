/* global require, process, __dirname */

'use strict';

const pa11y = require( 'pa11y' );
const chalk = require( 'chalk' );
const packageJson = require( '../../../package.json' );
const testingUrls = packageJson.testing.urls;
const user = 'pa11y-bot-2';
const pass = 'iiF#zroi$FDRzJuCTeBTWGiQ';

// Initialize variables
let stageActions = '';
let url;
let key;

// Loop through all the URLs and set the test destination
if ( process.argv[2] ) {

	for ( key in testingUrls ) {

		if ( key === process.argv[2] ) {

			// Set the testing URL
			url = packageJson.testing.urls[key];

			// If staging, it will need to sign into WordPress
			if ( 'staging' === key && '' !== user &&  '' !== pass ) {
	
				// Set up actions for staging, we don't need them for any other environment
				stageActions = [
					'set field #user_login to ' + user,
					'set field #user_pass to ' + pass,
					'click element #wp-submit',
					'wait for url to be ' + url
				];

			} else {

				console.log(' ');
				console.log( chalk.red.bold( '✘ Please provide staging credentials' ) );
				console.log(' ');
				console.log(' ');
				process.exit( 1 );

			}

		}

	}

} else {

	url = packageJson.testing.urls.local;

}

// Set up the pa11y config options
const config = {
	standard: packageJson.testing.accessibility.compliance,
	hideElements: '#wpadminbar',
	includeWarnings: true,
	rootElement: 'body',
	threshold: 2,
	timeout: 20000,
	userAgent: 'pa11y',
	width: 1280,
	ignore: [
		'notice'
	],
	actions: stageActions,
	log: {
		debug: console.log.bind( console ),
		error: console.error.bind( console ),
		info: console.log.bind( console )
	},
	chromeLaunchConfig: {
		ignoreHTTPSErrors: true
	}
};

/**
 * Run Accessibility Test
 * @param {string} url test URL
 * @param {object} config test configuration option
 * @param {Function} [cb] Callback
 * @returns {object} test results
 */
pa11y( url, config, ( error, results ) => {
	
	if( error ) {

		return console.error( error );

	} else if ( results.issues.length ) {

		console.log( results );

	} else {

		console.log( chalk.green.bold( '✔ All accessibility tests have passed.' ) );

	}

} );
