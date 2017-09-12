var config = {
    paths:{
        "my_module":"Package_Module/my_module"
    }
};

// alert("Done"); 

// If you want to include a jQuery plugin for use in Magento 2, 
// you’ll need to do it via RequireJS. Still, no guarantees that 
// plugin will be loaded after jQuery
// var config = {
//     paths:{
//         "jquery.cookie":"Package_Module/path/to/jquery.cookie.min"
//     }
// };
// requirejs(['jquery','jquery.cookie'], function(jQuery, jQueryCookie){
    //my code here
// });
// 
// Solution
// The RequireJS shim configuration directive
//  allows you to configure what I’ll call “load order” dependencies
// var config = {
//     paths:{
//         "jquery.cookie":"Package_Module/path/to/jquery.cookie.min"
//     },
//     shim:{
//         'jquery.cookie':{
//             'deps':['jquery']
//         }
//     }
// };