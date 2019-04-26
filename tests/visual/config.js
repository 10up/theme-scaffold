/* global module */

'use strict';

/**
 * Set config options for BackstopJS
 *
 * @param viewports array Viewports to be tested.
 * @param scenarios array Scenarios to be tested.
 */
const config = ( viewports, scenarios ) => {

	return {
		id: 'tenup-scaffold',
		viewports: viewports,
		scenarios: scenarios,
		onBeforeScript: 'puppet/onBefore.js',
		onReadyScript: 'puppet/onReady.js',
		cookiePath: 'backstop_data/engine_scripts/cookies.json',
		readyEvent: '',
		misMatchThreshold: 0.1,
		paths: {
			'bitmaps_reference': 'backstop_data/bitmaps_reference',
			'bitmaps_test': 'backstop_data/bitmaps_test',
			'engine_scripts': 'backstop_data/engine_scripts',
			'html_report': 'backstop_data/html_report',
			'ci_report': 'backstop_data/ci_report'
		},
		report: ['browser'],
		engine: 'puppeteer',
		engineFlags: [],
		asyncCaptureLimit: 5,
		asyncCompareLimit: 50,
		debug: false,
		debugWindow: false,
	};
};

module.exports = config;
