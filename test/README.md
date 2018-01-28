# Unit Testing with Jasmine and Karma

## Background

 - **Jasmine** is a behavior-driven development framework for testing JavaScript code.
 - **Karma** is a test runner that knows how to execute tests written in Jasmine (or another JS test framework) and report results.

## General Setup
1. Ensure you have [Node.js](https://nodejs.org/en/) installed.
2. Install Jasmine </br>
`npm install --save-dev jasmine`
3. Install Karma </br>
`npm install --save-dev karma`
4. Install Karma browser dependencies </br>
`npm install --save-dev karma-jasmine karma-<browserName>-launcher`

## Running Tests
To run all test suites, use: </br>
`karma start --single-run`
