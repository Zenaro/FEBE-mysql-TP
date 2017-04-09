/**
 * Created by zenaro on 16-6-16.
 */
//设置configuration
seajs.config({
    base: "../Lib",
    alias: {
        "jquery": "jquery/jquery.js"
    }
});
seajs.use('../public/script/common/main'); //引入main.js

angular.module('routingApp', ['ngRoute'])
    .controller('indexCtrl', function($scope) {
        seajs.use('../public/script/index/main');
    })
    .controller('my', function($scope) {
        seajs.use('../public/script/my/main');
    })
    .controller('result', function() {
        seajs.use('../public/script/result/main');
    })
    .controller('login', function() {
        seajs.use('../public/script/login/main');
    })
    .controller('reg', function() {
        seajs.use('../public/script/reg/main');
    })
    .config(function($logProvider, $routeProvider) {
        $logProvider.debugEnabled(true);

        $routeProvider
            .when('/home', {
                templateUrl: 'index.html',
                controller: 'indexCtrl'
            })
            .when('/my', {
                templateUrl: 'my.html',
                controller: 'my'
            })
            .when('/result', {
                templateUrl: 'result.html',
                controller: 'result'
            })
            .when('/login', {
                templateUrl: 'login.html',
                controller: 'login'
            })
            .when('/reg', {
                templateUrl: 'reg.html',
                controller: 'reg'
            })
            .when('/upload', {
                templateUrl: 'upload.html'
            })
            .otherwise({
                redirectTo: '/home'
            });
    });