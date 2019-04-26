/* global module */

'use strict';

/**
 * Add custom BackstopJS scenario options. 'urlName' must match the testing.urls name in package.json.
 *
 * @type {Array}
 */
const customScenarios = [
	/*
	{
		urlName: 'local',
		options: {
			label: 'Custom Local Label',
			readySelector: '.some-selector',
			delay: 2000
		}
	},
	{
		urlName: 'staging',
		options: {
			hoverSelector: '.some-selector',
			postInteractionWait: '.new-selector'
		}
	}
	*/
];

module.exports = customScenarios;
