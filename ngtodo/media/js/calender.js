/*
* @package			Joomla.site
* @subpackage		NG Todo
* @author			Kumar
* @copyright		Weblogicx India Private Limited. All rights reserved.
* @licence			GNU GPL V2 or later
*/

//ng-app module 
var app = angular.module('angularjs-starter', ['$strap.directives']);
app.controller('calenderCtrl', function($scope, $http, $cookieStore, $templateCache, $anchorScroll, $element, $window, $location) {

  /*
   * Datepicker directive.
   * 
   * Get today date.
   */ 
  $scope.datepicker = {date: new Date()};

});



     	
		
