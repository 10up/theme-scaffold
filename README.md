10up Scaffold
=====================

At 10up, we strive to provide digital products that yield a top-notch user experience. In order to improve both our efficiency and consistency, we need to standardize what we use and how we use it. This theme scaffold allows us to share initial set up procedures to make sure all projects can get up and running as quickly as possible while closely adhering to 10up's high quality standards.

<a href="http://10up.com/contact/"><img src="https://10updotcom-uploads.s3.amazonaws.com/uploads/2016/08/10up_github_banner-2.png" alt="Work with 10up, we create amazing websites and tools that make content management simple and fun using open source tools and platforms"></a>

## Dependencies

1. [Node & NPM](https://www.npmjs.com/get-npm) - Build packages and 3rd party dependencies are managed through NPM, so you will need that installed globally
2. [Gulp](https://gulpjs.com/) - Gulp is used as the main task runner, it runs PostCSS, processes images, handles SVG sprites (if needed), and executes Webpack
3. [Webpack](https://webpack.js.org/) - Webpack is used to process the JavaScript
4. [Composer](https://getcomposer.org/) - Composer is used to manage PHP.

## Getting Started

### Quick Start
Install 10up's command line tool for scaffolding new projects. You can download it from the [Project Scaffold repository](https://github.com/10up/project-scaffold). Setting up a new theme is as easy as running `create-10up theme theme-name-here` in the terminal!

Browsersync requires a local development URL. This is currently set in the `package.json`, as `proxyUrl`.

### Direct Install
- Clone the repository
- Rename folder theme-scaffold -> your project's name
- If copying files manually to an existing theme directory instead of cloning directly from the repository, make sure to include the following files which may be hidden:

```
.babelrc
.browserslistrc
.editorconfig
.eslintignore
.eslintrc
.gitignore
```

The NPM commands will fail without these files present.

- Do case-sensitive search/replace for the following:

	- TenUpScaffold
	- TENUP_SCAFFOLD
	- tenup-scaffold
	- tenup_scaffold
	- 10up Scaffold

- `cd` into the theme folder
- run `npm run start`

## NPM Commands

`npm run start` (install dependencies and run initial gulp)

`npm run watch` (watch)

`npm run build` (build all files)

`npm run deploy` (build all files for deploy)

`npm run test-a11y` (run accessibility tests)

## Composer Commands

`composer lint` (lint PHP files)

`composer lint-fix` (lint PHP files and automatically correct coding standard violations)

## Automated Style Guide
The Theme Scaffolding ships with a default style guide you can find in `/templates/page-styleguide.php`. This file contains all the basic HTML elements you would find at the very top of the cascade (headings, typography, tables, forms, etc.) These base elements will be styled and displayed as you naturally build out your CSS. The style guide also automatically pulls in the color variables used in the project. Any hex codes added into `/assets/css/frontend/global/variables.css` will be automatically displayed in the style guide. To set up your style guide, you just need to create a new page in WordPress and assign it the "Style Guide" template.

If you need to update the core styles that power the style guide they are located in `/assets/css/styleguide` and will naturally process with the rest of the CSS.

As your site grows you can add components to the style guide by updating `/templates/page-styleguide.php` as you see fit. All the JS and CSS for the site will already be included in the template, so everything should just work.

## Automated Accessibility Testing
Automated accessibility testing in the Theme Scaffolding is done with [Pa11y](https://www.npmjs.com/package/pa11y) and is executed with the command `npm run test-a11y`. You can find any configuration options inside your `package.json` file inside the `testing` object. You will see default URL options (local, staging, production), but you can add as many as you'd like. The default script runs over the `local` URL and any others will run with an argument like `npm run test-a11y production`, over a production URL. You can also add more template URLs for testing like `npm run a11y-test article-template`. Be sure to check with your systems person on a project to make sure accessibility tests are also hooked up through the deploy process.

Compliance levels can also be updated through the `testing.accessibility.compliance` object in the `package.json` file. The default is WCAG Level A, but it can be updated to anything listed in the [pa11y documentation](https://github.com/pa11y/pa11y).

The test file lives in `/tests/accessibility/compliance/pa11y.js` if any edits are needed (such as staging credentials, if you're running tests in an environment that requires authentication).

## Contributing

We don't know everything! We welcome pull requests and spirited, but respectful, debates. Please contribute via [pull requests on GitHub](https://github.com/10up/theme-scaffold/compare).

1. Fork it!
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Added some great feature!'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## Learn more about the default packages used with this project

- [Babel core](https://www.npmjs.com/package/babel-core)
- [Babel eslint](https://www.npmjs.com/package/babel-eslint)
- [Babel loader](https://www.npmjs.com/package/babel-loader)
- [Babel preset env](https://www.npmjs.com/package/babel-preset-env)
- [Browsersync](https://browsersync.io/)
- [Can I Use DB](https://www.npmjs.com/package/caniuse-db)
- [Chalk](https://www.npmjs.com/package/chalk)
- [Del](https://www.npmjs.com/package/del)
- [Eslint](https://www.npmjs.com/package/eslint)
- [Eslint loader](https://www.npmjs.com/package/eslint-loader)
- [Gulp](https://www.npmjs.com/package/gulp)
- [Gulp CSSNano](https://www.npmjs.com/package/gulp-cssnano)
- [Gulp filter](https://www.npmjs.com/package/gulp-filter)
- [Gulp PostCSS](https://www.npmjs.com/package/gulp-postcss)
- [Gulp Rename](https://www.npmjs.com/package/gulp-rename)
- [Gulp Sourcemaps](https://www.npmjs.com/package/gulp-sourcemaps)
- [Pa11y](https://www.npmjs.com/package/pa11y)
- [PostCSS CSSNext](https://www.npmjs.com/package/gulp-postcss)
- [PostCSS Import](https://www.npmjs.com/package/postcss-import)
- [Pump](https://www.npmjs.com/package/pump)
- [Require DIR](https://www.npmjs.com/package/require-dir)
- [Run Sequence](https://www.npmjs.com/package/run-sequence)
- [Webpack](https://www.npmjs.com/package/webpack)
- [Webpack CLI](https://www.npmjs.com/package/webpack-cli)
- [Webpack Stream](https://www.npmjs.com/package/webpack-stream)
- [Husky@next](https://www.npmjs.com/package/husky)
- [Lint Staged](https://www.npmjs.com/package/lint-staged)
- [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer)
