/* global require, process, module */

'use strict';

/*
* Automatically builds BackstopJS scenarios from the testing.urls object in package.json.
* Add custom BackstopJS scenario options in ./custom-scenarios.js.
*/
const chalk = require( 'chalk' );
const packageJson = require( '../../package.json' );
const testingUrls = packageJson.testing.urls;
const customScenarios = require( './custom-scenarios' );

// Initialize variables.
const scenarios = [];
let urlName;

for ( urlName in testingUrls ) {

	// Return early if the URL object exists, but is empty.
	if ( '' === packageJson.testing.urls[urlName] ) {
		console.log( chalk.red.bold( `✘ Error: Please add a URL for “${ urlName }”` ) );
		console.log( '' );
		process.exit( 1 );
		return;
	}

	// Match any custom scenarios.
	let matchedScenario = [];
	if ( 0 < customScenarios.length ) {
		matchedScenario = customScenarios.filter( scenario => scenario.urlName === urlName );
	}

	// Add to scenarios array.
	scenarios.push(
		{
			label: urlName,
			url: packageJson.testing.urls[urlName],
			...( matchedScenario.length && matchedScenario[0].options )
		}
	);
}

module.exports = scenarios;
