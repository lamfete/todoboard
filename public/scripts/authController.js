(function() {
    'use strict';

    var app = angular.module('todoApp');
    app.controller('authController', AuthController);

    function AuthController($auth, $state) {
        var vm = this;

        vm.login = function() {
            var credentials = {
                email: vm.email,
                password: vm.password
            }

            // use satellizer's $auth service to login
            $auth.login(credentials).then(function(data){
                // if login successfull, redirect to the users state
                $state.go('todo', {});
            });
        }
    }
})();
