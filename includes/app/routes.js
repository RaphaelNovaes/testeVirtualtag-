var mainApp =  angular.module('main-App',['ngRoute','lr.upload','ngSanitize']);

mainApp.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
		when('/', {
			templateUrl: 'MainView',
			controller: 'mainController'
		}).
		when('/NewUser', {
			templateUrl: 'NewUser',
			controller: 'mainController'
		}).
		when('/ChangePassView', {
			templateUrl: 'ChangePassView',
			controller: 'mainController'
		}).
		when('/ChangeImgView', {
			templateUrl: 'ChangeImgView',
			controller: 'mainController'
		}).
		when('/ProductsView', {
			templateUrl: 'ProductsView',
			controller: 'mainController'
		}).
		when('/DefinitionsView', {
			templateUrl: 'DefinitionsView',
			controller: 'mainController'
		}).
		when('/validImg', {
			templateUrl: 'ValidImg',
			controller: 'mainController'
		}).
		otherwise({
        	redirectTo: '/'
      	});;
	}
]);