(function() {

    'use strict';

    var app = angular.module('todoApp', ['ui.router', 'satellizer', 'ngMaterial']);

    app.config(function($stateProvider, $urlRouterProvider, $authProvider, $mdThemingProvider) {

        // satellizer configuration that specifies which API
        // route the JWT should be retrieved from
        $authProvider.loginUrl = '/api/authenticate';

        // redirect to the auth state if any other states
        // are requested other than users
        $urlRouterProvider.otherwise('/auth');

        $stateProvider
        .state('auth', {
            url: '/auth',
            templateUrl: '../views/authView.html',
            controller: 'authController as auth'
        })
        .state('todo', {
            url: '/todo',
            templateUrl: '../views/todoView.html',
            controller: 'todoController as todo'
        });
    });

    app.controller('appCtrl', ['$scope', '$mdSidenav', function($scope, $mdSidenav){
        $scope.toggleSidenav = function(menuId) {
            $mdSidenav(menuId).toggle();
        };
    }]);
})();

/*
var todoBoard = angular.module('todoApp', ['ui.router']);

todoBoard.config(function($stateProvider) {
    var todoState = {
        name: 'todo',
        url: '/todo',
        template: '<h3>hello world!</h3>'
    }

    var aboutState = {
        name: 'about',
        url: '/about',
        template: '<h3>Lorem Ipsum</h3>'
    }

    $stateProvider.state(todoState);
    $stateProvider.state(aboutState);
});*/
