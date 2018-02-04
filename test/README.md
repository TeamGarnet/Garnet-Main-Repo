# Unit Tests - Karma, Jasmine, PHPUnit

## Background
- **Jasmine** is a behavior-driven development framework for testing JavaScript code.
- **Karma** is a test runner that knows how to execute tests written in Jasmine and report results.
- **PHPUnit** is a unit testing framework for the PHP programming language. 

## Karma & Jasmine Setup
1. Ensure you have [Node.js](https://nodejs.org/en/) installed.
2. Install Jasmine </br>
 `$ npm install --save-dev jasmine`
3. Install Karma </br>
 `$ npm install --save-dev karma`
4. Install Karma browser dependencies </br>
 `$ npm install --save-dev karma-jasmine karma-chrome-launcher`
 `$ npm install --save-dev karma-jasmine karma-firefox-launcher`
 5. Check that you actually have Karma & Jasmine installed
	```
	$ karma --version
	Karma version: 2.0.0

	$ npm jasmine --version
	5.6.0
	```
## Running Jasmine Tests with Karma
From the repo folder:
1. `$ cd/test`
2. To run all test suites </br>
`$ karma start --single-run`

## PHPUnit Setup
1. Ensure you have the latest stable [PHP release](http://windows.php.net/download/) downloaded and added to your `PATH` variable.
2. Download the [PHAR](https://phar.phpunit.de/phpunit-6.5.phar) and save the file as *phpunit.phar* in a desired directory.
3. Add that directory to your `PATH`.
4. Exit your CLI (Terminal, Windows Command Prompt, etc.) and start a new instance.
5. Check that you have PHP and PHPUnit installed. You should see a similar output below.
```
$ php -v
PHP 7.2.2 (cli) (built: Jan 31 2018 19:31:17) ( ZTS MSVC15 (Visual C++ 2017) x64 )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies

$ phpunit --version
PHPUnit 6.5.6 by Sebastian Bergmann and contributors.
```
You may want to check the [PHPUnit installation manual](https://phpunit.de/manual/current/en/installation.html) to get specific setup for your OS.

## Running PHPUnit Tests
From the repo folder:
1. `$ cd/test`
2. To run all test suites </br>
`$ phpunit --configuration="phpunit.xml"`

### Reports
Reports for all Jasmine and PHPUnit tests will be generated in the `test/reports` directory. </br>
 
## Resources
- [Introduction to Writing Jasmine Tests](https://jasmine.github.io/edge/introduction.html)
- [PHPUnit Manual](https://phpunit.de/manual/current/en/index.html)