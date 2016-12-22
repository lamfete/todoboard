(function() {
    'use strict';

    angular
        .module('todoApp')
        .controller('todoController', TodoController)
        .config(['$qProvider', function ($qProvider) {
            $qProvider.errorOnUnhandledRejections(false);
        }]);

    function TodoController($http) {
        var vm = this;

        vm.todos;
        vm.error;

        vm.getTodos = function() {
            $http({
                method: 'GET',
                url: 'api/todo'
            }).then(function successCallback(response) {
                vm.todos = response;
            }, function errorCallback(response) {
                vm.error = response;
            });
        }
    }

})();
