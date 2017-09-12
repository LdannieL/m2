define([], function(){
    'use strict';    
    console.log("Called this Hook.");
    return function(targetModule){
        targetModule.crazyPropertyAddedHere = 'yes';
        //replace method implementations on RequireJS modules that return objects
        // targetModule.someMethod = function(){
        //     //replacement for `someMethod
        // }
        return targetModule;

        // To test in browser console
        // > module = requirejs('Magento_Customer/js/view/customer');
		// > console.log(module.crazyPropertyAddedHere)
		// "yes"



        // //if the module in question returns a uiClass based object, 
        // //you could use uiClass's extend method to return a different class
        // //that extended the method, but used uiClass‘s _super() feature to call the parent method
        
        // //if targetModule is a uiClass based object
        // return targetModule.extend({
        //     someMethod:function()
        //     {
        //         var result = this._super(); //call parent method

        //         //do your new stuff

        //         return result;
        //     }
        // });
    };
});