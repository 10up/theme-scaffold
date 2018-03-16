# WPMakeoutPut

# Requirements

## JS
* es6
	* Minified/non-midified compiled files
	* Don't commit compiled files :|
* webpack
* gulp
	* Do we need a task files with webpack?
* .eslint
	* Want to rely on airbnb as a primary plugin
* .jscs


# Questions
What are these tools providing us over just straight webpack?
 - It's worth keeping gulp... I've been playing with webpack and it's set up to add styles directly through JS. There is a way to process using webpack and then use an extraction system to pull it out into a file. In general, gulp is setting up for a super modularized web-app. We are some steps away from that. -LW
	- I agree that keeping gulp is a good tool for use and will help users ramp up quicker on the tools. - NS
 - The other thing that gulp gives us is the ability to run other things through gulp, such as a task to run testing. A task for running a clean build. These are some of the features of the old version that we _probably_ shouldn't just kill, but interested to chat about it. -LW
	- This is kinda the only other reason for keeping these commands - NS

# Thoughts from 1/23
Stick to NPM scripts
* How do we manage localization files?
	* [WP-Pot](https://www.npmjs.com/package/wp-pot)
* Store Config files in a directory
	* This will simplify the directory structure
* How do we deal with styles and Webpack
	* Need separate files for the styles

# Thoughts from 2/6
Allen - Limited use of Webpack
* Remove the requirement for JSCS
* Compiling - performance of build tools.
* Using Webpack
	* Need to have alternative use cases and suggestions.
	* Need to have defined ways of doing things
* Touched on config folder again - needs to be one place where everything lives.
	* This can be configured via the entry-point for most task-runner API.
	* Point of this is to make it easy to understand
* Should we track configs in their own repository or should they be outside?
	* If they are in - they should conform to WP
	* If they are in their own repo - they don't have to.


# Thoughts from 2/27
Allen - Use Webpack please.... :face_with_rolling_eyes:
* Remove the requirement for JSCS
* Remove Build command?
* Maybe move to component based configs
* Allen to start with a theme build

# Thoughts from 6/23
- What are our desired task runner features?
	- SCSS
		- [x] Minify
		- [ ] ~~Globbing?~~
		- [x] Concat
		- [x] Autoprefixer
		- [ ] Lint
		- [x] PostCSS
		- [x] CSS Next
	- JS
		- [x] Uglify / Minify
		- [x] Concat
		- [x] ES6
		- [x] Lint
	- SVG
		- [ ] Optimization
		- [ ] Generate Sprite
	- Workflow
		- [x] Live Reload
