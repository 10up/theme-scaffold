/* global module */

'use strict';

/**
 * Add custom BackstopJS scenario options. 'urlName' must match the testing.urls name in package.json.
 * Options available at https://github.com/garris/BackstopJS#advanced-scenarios
 *
 * @type {Array}
 */
const customScenarios = [
	/*
	{
		urlName: 'homepage',
		options: {
			readySelector: '.some-element',
			hoverSelector: '.some-button',
			postInteractionWait: 1000
		}
	},
	{
		urlName: 'article',
		options: {
			clickSelector: '.some-button',
			postInteractionWait: '.new-selector'
		}
	}
	*/
];

module.exports = customScenarios;
