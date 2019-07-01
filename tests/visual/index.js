/* global require, module */

'use strict';

const viewports = require( './viewports' );
const scenarios = require( './scenarios' );
const config    = require( './config' );

module.exports = config( viewports, scenarios );
