// This is a dummy Jasmine test used as part of the initial Jasmine/Karma setup.
describe("dummy test suite", function(){	
	it("dummy test case", function() {
		expect(true).toBe(true);
	});
	
	it("hello world test case", function() {
		expect(helloWorld()).toEqual("Hello World");
	});
});